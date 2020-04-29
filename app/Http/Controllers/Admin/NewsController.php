<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use App\models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->orderByDesc('id')
            ->paginate(5);

        return view('admin.news.index')->with('news', $news);
    }

    public function create(News $news)
    {
        $categories = Categories::query()->select(['id', 'category'])->get();

        return view('admin.news.create')
            ->with('categories', $categories)->with('news', $news);
    }

    public function edit(News $news)
    {
        $categories = Categories::query()->select(['id', 'category'])->get();

        return view('admin.news.create')
            ->with('categories', $categories)->with('news', $news);
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->back()
            ->with('success', 'Новость успешно удалена!');
    }

    public function update(Request $request, News $news)
    {
        if ($request['is_private'] != 1) {
            $request['is_private'] = 0;
        }
        $result = $this->saveData($request, $news);

        if ($result) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', 'Новость успешно изменена!');
        } else {
            $request->flash();
            return redirect()->route('admin.news.index')
                ->with('error', 'Ошибка редактирования новости!');
        }
    }

    public function store(Request $request)
    {
        $news = new News();

        $result = $this->saveData($request, $news);

        if ($result) {
            return redirect()->route('admin.index')
                ->with('success', 'Новость успешно создана!');
        } else {
            $request->flash();
            return redirect()->route('admin.news.create')
                ->with('error', 'Ошибка добавления новости!');
        }
    }

    private function saveData(Request $request, News $news)
    {
        if ($request->file('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $news->image = $url;
        }

        $this->validate($request, News::rules(), [], News::attributeNames());
        $news->fill($request->all());
        return $news->save();
    }
}

