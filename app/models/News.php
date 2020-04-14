<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    public static function getNewsByCategoryName($name)
    {
        return DB::table('news')
            ->where('category_id', Categories::getOneCategoryByName($name)->id)
            ->get();
    }

    public static function getAllNews()
    {
        return DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.*')
            ->get();
    }

    public static function getNewsOne($categoryId, $newsId)
    {
        return DB::table('news')
            ->where('category_id', $categoryId)
            ->where('id', $newsId)
            ->first();
    }
}
