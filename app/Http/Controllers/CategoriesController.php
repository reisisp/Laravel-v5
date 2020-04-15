<?php

namespace App\Http\Controllers;

use App\models\News;
use App\models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::query()
            ->select(['id', 'category_en', 'category_ru'])
            ->get();

        return view('news.allCategories')
            ->with('categories', $categories);
    }

    public function show($name)
    {
        $category = Categories::query()
            ->select(['id', 'category_ru', 'category_en'])
            ->where('category_en', $name)
            ->get();
        $news = News::query()
            ->where('is_private', false)
            ->where('category_id', $category[0]->id)
            ->paginate(5);

        return view('news.categoryOne')
            ->with('category', $category[0])
            ->with('news', $news);
    }
}
