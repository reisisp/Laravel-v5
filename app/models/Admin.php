<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public static function insertNewsOne($request)
    {
        $data = (array)$request->request;
        $newsOne = [];
        foreach ($data as $key => $value) {
            $newsOne['title'] = $value['title'];
            $newsOne['news_text'] = $value['news_text'];
            if ($key == 'is_private') {
                $newsOne['is_private'] = $value['is_private'];
            } else {
                $newsOne['is_private'] = 0;
            }
            $newsOne['created_at'] = null;
            $newsOne['updated_at'] = null;
            $newsOne['category_id'] = $value['category_id'];
        }
        return DB::table('news')->insertGetId($newsOne);
    }
}
