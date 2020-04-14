<?php

namespace App\Http\Controllers\Admin;

use App\models\News;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->orderByDesc('id')
            ->paginate(5);

        return view('admin.index', ['news' => $news]);
    }

    public function json()
    {
        return response()->json(News::getAllNews())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
