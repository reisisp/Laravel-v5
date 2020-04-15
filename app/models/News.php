<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $fillable = ['title', 'news_text', 'is_private', 'category_id'];

    public static function getAllNews()
    {
        return DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.*')
            ->where('is_private', false)
            ->orderByDesc('news.id')
            ->paginate(5);
    }
}
