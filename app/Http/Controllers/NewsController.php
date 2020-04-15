<?php

namespace App\Http\Controllers;

use App\models\Categories;
use App\models\News;

class NewsController extends Controller
{
    public function index()
    {
        // Здесь join 2х таблиц, не нашел как следать при помощи ORM join
        $news = News::getAllNews();

        return view('news.index')
            ->with('news', $news);
    }

    public function show($name, $id)
    {
        $news = News::query()
            ->find($id);
        $category = Categories::query()
            ->select(['id', 'category_ru', 'category_en'])
            ->where('category_en', $name)
            ->where('id', $news->category_id)
            ->get();


        return view('news.newsCard')
            ->with('categories', $category)
            ->with('newsOne', $news);


    }
}
