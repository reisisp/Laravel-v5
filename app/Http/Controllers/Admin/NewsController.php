<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\News;

class NewsController extends Controller
{
    public function edit(Request $request, News $news)
    {
        return view('admin.create', [
            'news' => $news,
            'categories' => Categories::query()->select(['id', 'category_ru'])->get()
        ]);
    }

    public function create(Request $request)
    {
        $news = new News();

        if ($request->isMethod('post')) {

            $url = null;

            $data = $this->validate($request, News::rules(), [], News::attributeNames());

            $result = $news->fill($data)->save();

            if ($result) {
                return redirect()->route('admin.index')
                    ->with('success', 'Новость успешно создана!');
            } else {
                $request->flash();
                return redirect()->route('admin.create')
                    ->with('error', 'Ошибка добавления новости!');
            }
        }

        return view('admin.create', [
            'categories' => Categories::query()->select(['id', 'category_ru'])->get(),
            'news' => $news
        ]);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Новость успешно удалена!');
    }

    public function update(Request $request, News $news)
    {
        $news->fill($request->all());
        $news->save();
        return redirect()
            ->route('admin.index')
            ->with('success', 'Новость успешно изменена!');
    }
}
