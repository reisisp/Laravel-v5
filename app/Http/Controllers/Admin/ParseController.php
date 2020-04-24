<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use App\models\Categories;
use App\models\News;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    protected $links = [
        'https://news.yandex.ru/music.rss',
        'https://news.yandex.ru/army.rss'
    ];

    public function index()
    {
        foreach ($this->links as $link) {
            $xml = XmlParser::load($link);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses' => 'channel.link'],
                'description' => ['uses' => 'channel.description'],
                'image' => ['uses' => 'channel.image.url'],
                'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]']
            ]);

            $this->checkCategory($data['title']);
            $categoryId = $this->getCategoryId($data['title']);
            $this->addNews($data['news'], $categoryId);
        }
        return redirect()
            ->route('admin.index')
            ->with('success', 'Успех!');
    }

    private function checkCategory($category)
    {
        $categories = Categories::query()->get();

        if (!$categories->contains('category', $category)) {
            $this->addCategory($category);
        }
    }

    private function addCategory($category)
    {
        $categories = new Categories();
        $categories['category'] = $category;
        $categories['slug'] = Str::slug($category);
        $categories->save();
    }

    private function getCategoryId($category)
    {
        return Categories::query()->where('category', $category)->value('id');
    }

    private function addNews($parsedData, $catId)
    {
        if (!(News::query()->where('category_id', $catId)->first())) {
            $this->saveNews($parsedData, $catId);
        } else {
            $newsArray = [];
            $lastNews = News::query()->orderByDesc('id')->first();
            foreach ($parsedData as $key => $newsCard) {
                if (in_array($lastNews->title, $newsCard)) {
                    $newsArray = array_splice($parsedData, $key + 1);
                };
            }
            $this->saveNews($newsArray, $catId);
        };
    }

    private function saveNews($array, $category)
    {
        foreach ($array as $newsCard) {
            $news = new News();
            $news['title'] = $newsCard['title'];
            $news['news_text'] = $newsCard['description'];
            $news['is_private'] = 0;
            $news['category_id'] = $category;
            $news->save();
        }
    }
}
