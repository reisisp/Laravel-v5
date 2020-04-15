<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\News;

class NewsController extends Controller
{
    public function create(Request $request)
    {
        $news = new News();

        if ($request->isMethod('post')) {

            $url = null;

            $news->fill($request->all())->save();

            return redirect()
                ->route('admin.index')
                ->with('success', 'Новость успешно создана!');
        }

        return view('admin.create', [
            'categories' => Categories::query()->select(['id', 'category_ru'])->get(),
            'news' => $news
        ]);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Новость успешно удалена!');
    }

    public function edit(Request $request, News $news)
    {
        return view('admin.create', [
            'news' => $news,
            'categories' => Categories::query()->select(['id', 'category_ru'])->get()
        ]);
    }

    public function update(Request $request, News $news)
    {
        if ($request->isMethod('post')) {
            $news->fill($request->all());
            $news->save();
            return redirect()
                ->route('admin.index')
                ->with('success', 'Новость успешно изменена!');
        }
    }
}
