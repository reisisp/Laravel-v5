<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\NewsParsing;
use App\models\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use App\models\Categories;
use App\models\News;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    public function index() {
        $rssLinks = Resources::query()->select('url')->get();


        foreach ($rssLinks as $link) {
            NewsParsing::dispatch($link);
        }

        return redirect()
            ->route('admin.index')
            ->with('success', 'Успех!');
    }
}
