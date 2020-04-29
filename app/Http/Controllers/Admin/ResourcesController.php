<?php

namespace App\Http\Controllers\Admin;

use App\models\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resources::query()
            ->orderByDesc('id')
            ->paginate(5);

        return view('admin.resources.index')->with('resources', $resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Resources $resources)
    {
        return view('admin.resources.create')->with('resources', $resources);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resources = new Resources();

        $result = $this->saveData($request, $resources);

        if ($result) {
            return redirect()->route('admin.index')
                ->with('success', 'Rss успешно создан!');
        } else {
            $request->flash();
            return redirect()->route('admin.resources.create')
                ->with('error', 'Ошибка добавления Rss!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Resources $resource)
    {
        return view('admin.resources.create')->with('resources', $resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resources $resource)
    {
        $result = $this->saveData($request, $resource);

        if ($result) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', 'Rss успешно изменен!');
        } else {
            $request->flash();
            return redirect()->route('admin.resources.index')
                ->with('error', 'Ошибка редактирования Rss!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resources $resource)
    {
        $resource->delete();

        return redirect()->back()
            ->with('success', 'Rss успешно удален!');
    }

    private function saveData(Request $request, Resources $resources)
    {
        $this->validate($request, Resources::rules(), [], Resources::attributeNames());
        $resources->fill($request->all());
        return $resources->save();
    }
}
