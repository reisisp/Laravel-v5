<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::query()
            ->orderByDesc('category')
            ->paginate(5);

        return view('admin.categories.index')->with('categories', $categories);
    }

    public function create(Categories $categories)
    {
        return view('admin.categories.create')->with('categories', $categories);
    }

    public function edit(Categories $category)
    {
        return view('admin.categories.create')->with('categories', $category);
    }

    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->back()
            ->with('success', 'Категория успешно удалена!');
    }

    public function update(Request $request, Categories $category)
    {
        $result = $this->saveData($request, $category);

        if ($result) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Новость успешно изменена!');
        } else {
            $request->flash();
            return redirect()->route('admin.categories.index')
                ->with('error', 'Ошибка редактирования новости!');
        }
    }

    public function store(Request $request)
    {
        $categories = new Categories();

        $result = $this->saveData($request, $categories);

        if ($result) {
            return redirect()->route('admin.index')
                ->with('success', 'Категория успешно создана!');
        } else {
            $request->flash();
            return redirect()->route('admin.categories.create')
                ->with('error', 'Ошибка добавления категории!');
        }
    }

    private function saveData(Request $request, Categories $categories)
    {
        $request['slug'] = Str::slug($request['category']);
        $this->validate($request, Categories::rules(), [], Categories::attributeNames());
        $categories->fill($request->all());
        return $categories->save();
    }
}
