<?php

namespace App\Http\Controllers;

use App\models\Categories;
use App\models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index')
            ->with('news', News::getAllNews())
            ->with('popularCategories', Categories::getPopularCategories());
    }

    public function show($name, $id)
    {
        $category = Categories::getOneCategoryByName($name);
        if ($category) {
            $newsOne = News::getNewsOne($category->id, $id);
            if ($newsOne) {
                return view('news.newsCard')
                    ->with('newsOne', $newsOne)
                    ->with('popularCategories', Categories::getPopularCategories());
            }
        }
        return redirect()
            ->route('categories.index');
    }
}
