<?php

namespace App\Http\Controllers\Admin;

use App\models\Admin;
use App\models\Categories;
use App\models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index')
            ->with('success', '');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            Admin::insertNewsOne($request);
            return view('admin.index')
                ->with('success', 'Новость успешно создана!');
        }
        return view('admin.create')
            ->with('categories', Categories::getCategories());
    }

    public function exportExcel()
    {
        $data = News::getAllNews();


        dd($data);
        return Excel::download($data, '123.xlsx' );
    }

    public function json()
    {
        return response()->json(News::getAllNews())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
