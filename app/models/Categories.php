<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category', 'slug'];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public static function attributeNames() {
        return [
            'category' => 'Название категории'
        ];
    }

    public static function rules() {
        return [
            'category' => 'required|min:5',
        ];
    }
}
