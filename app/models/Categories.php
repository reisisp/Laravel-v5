<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    public static function getCategories()
    {
        return DB::table('categories')
            ->get();
    }

    public static function getPopularCategories()
    {
        return DB::table('categories')
            ->get();
    }

    public static function getOneCategoryByName($name)
    {
        return DB::table('categories')
            ->where('category_en', $name)
            ->first();
    }

    public static function getCategoriesEnNames()
    {
        return DB::table('categories')
            ->pluck('category_en');
    }
}
