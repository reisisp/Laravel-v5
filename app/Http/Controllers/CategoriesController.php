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
            ->orderBy('category_ru')
            ->paginate(10);

        return view('news.allCategories')
            ->with('categories', $categories);
    }

    public function show($name)
    {
        $category = Categories::query()
            ->select(['id', 'category_ru'])
            ->where('category_en', $name)
            ->get();
        $news = News::query()
            ->where('category_id', $category[0]->id)
            ->where('is_private', false)
            ->orderByDesc('id')
            ->paginate(7);

        return view('news.categoryOne')
            ->with('news', $news);
    }
}
