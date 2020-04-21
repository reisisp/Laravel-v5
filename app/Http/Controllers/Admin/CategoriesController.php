<?php

namespace App\Http\Controllers\Admin;

use App\models\Categories;
use App\models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::query()
            ->orderByDesc('category_ru')
            ->paginate(5);

        return view('admin.categories.index')->with('categories', $categories);
    }

    public function create(Categories $categories)
    {
        return view('admin.categories.create')->with('categories', $categories);
    }

    public function edit(Categories $categories)
    {
        return dump($categories);
        //return view('admin.categories.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $categories = new Categories();

        $result = $this->saveData($request, $categories);

        if ($result) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Категория успешно создана!');
        } else {
            $request->flash();
            return redirect()->route('admin.categories.create')
                ->with('error', 'Ошибка добавления категории!');
        }
    }

    public function destroy(Categories $categories)
    {
        $categories->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категория успешно удалена!');
    }

    private function saveData(Request $request, Categories $categories)
    {
        $request['category_en'] = Str::slug($request['category_ru']);
        $this->validate($request, Categories::rules(), [], Categories::attributeNames());
        $categories->fill($request->all());
        return $categories->save();
    }


}
/* public function create(Request $request)
 {
     $categories = new Categories();

     if ($request->isMethod('post')) {

         $url = null;
         $request['category_en'] = Str::slug($request['category_ru']);

         $data = $this->validate($request, Categories::rules(), [], Categories::attributeNames());

         $result = $categories->fill($data)->save();

         if ($result) {
             return redirect()->route('admin.index')
                 ->with('success', 'Категория успешно создана!');
         } else {
             $request->flash();
             return redirect()->route('admin.categories.create')
                 ->with('error', 'Ошибка добавления новости!');
         }
     }

     return view('admin.categories.create', [
         'categories' => $categories
     ]);

 }*/


/*  public function edit(Request $request, Categories $categories)
  {
      return view('admin.categories.create', [
          'categories' => $categories
      ]);
  }

  public function update(Request $request, Categories $categories)
  {
      $request['category_en'] = \Str::slug($request['category_ru']);

      $categories->fill($request->all());
      $categories->save();
      return redirect()
          ->route('admin.categories.index')
          ->with('success', 'Новость успешно изменена!');
  }*/

