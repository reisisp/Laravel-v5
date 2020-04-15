<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category_ru', 'category_en'];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public static function attributeNames() {
        return [
            'category_ru' => 'Название категории'
        ];
    }

    public static function rules() {
        return [
            'category_ru' => 'required|min:5',
        ];
    }
}
