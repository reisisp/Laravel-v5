<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    protected $fillable = ['url', 'source'];

    public static function attributeNames() {
        return [
            'url' => 'URL',
            'source' => 'источник'
        ];
    }

    public static function rules() {
        return [
            'url' => 'required|min:5',
            'source' => 'required|min:5',
        ];
    }
}
