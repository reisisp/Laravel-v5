<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::query()
            ->orderByDesc('category_ru')
            ->paginate(5);
        return view('admin.category.index')->with('categories', $categories);
    }

    public function create(Request $request)
    {
        $categories = new Categories();

        if ($request->isMethod('post')) {

            $url = null;
            $request['category_en'] = \Str::slug($request['category_ru']);

            $data = $this->validate($request, Categories::rules(), [], Categories::attributeNames());

            $result = $categories->fill($data)->save();

            if ($result) {
                return redirect()->route('admin.index')
                    ->with('success', 'Категория успешно создана!');
            } else {
                $request->flash();
                return redirect()->route('admin.category.create')
                    ->with('error', 'Ошибка добавления новости!');
            }
        }

        return view('admin.category.create', [
            'categories' => $categories
        ]);

    }

    public function destroy(Categories $categories)
    {
        $categories->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Категория успешно удалена!');
    }

    public function edit(Request $request, Categories $categories)
    {
        return view('admin.category.create', [
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Categories $categories)
    {
        $request['category_en'] = \Str::slug($request['category_ru']);

        $categories->fill($request->all());
        $categories->save();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Новость успешно изменена!');
    }
}
