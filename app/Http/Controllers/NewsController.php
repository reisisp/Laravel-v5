<?php

namespace App\Http\Controllers;

use App\models\Categories;
use App\models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->where('is_private', false)
            ->orderByDesc('id')
            ->paginate(7);

        return view('news.index')->with('news', $news);
    }

    public function show($id)
    {
        $news = News::query()->find($id);

        if (!empty($news)) {
            return view('news.newsCard')->with('news', $news);
        } else {
            return redirect()->route('news.index');
        }
    }
}
