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
            'title' => 'Заголовок новости',
            'news_text' => 'Текст новости',
            'category_id' => "Категория новости",
            'is_private' => "Приватность"
        ];
    }

    public static function rules() {
        $tableNameCategory = (new Categories())->getTable();
        return [
            'title' => 'required|min:5|max:20',
            'news_text' => 'required|min:30',
            'category_id' => "required|exists:{$tableNameCategory},id",
            //поставил bool - но работает не так как я думал
            //'is_private' => "required|boolean"
        ];
    }
}
