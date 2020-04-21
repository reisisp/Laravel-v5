<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'news_text', 'is_private', 'category_id'];

    public function category() {
        return $this->belongsTo(Categories::class, 'category_id')->first();
    }

    public static function attributeNames() {
        return [
            'title' => 'Название новости',
            'news_text' => 'Текст новости',
            'category_id' => "Категория новости",
            'is_private' => "Приватность"
        ];
    }

    public static function rules() {
        $tableNameCategory = (new Categories())->getTable();
        return [
            'title' => 'required|min:5|max:20',
            'news_text' => 'required|min:5|max:50',
            'category_id' => "required|exists:{$tableNameCategory},id",
            'is_private' => 'sometimes|min:0|max:1'
        ];
    }
}
