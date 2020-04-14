<?php

namespace App\Http\Controllers;

use App\models\News;
use App\models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('news.allCategories')
            ->with('categories', Categories::getCategories())
            ->with('popularCategories', Categories::getPopularCategories());
    }

    public function show($name)
    {
        $category = Categories::getOneCategoryByName($name);
        if ($category) {
            return view('news.categoryOne')
                ->with('category', $category)
                ->with('news', News::getNewsByCategoryName($name))
                ->with('popularCategories', Categories::getPopularCategories());
        } else {
            return redirect()
                ->route('categories.index');
        }
    }
}
