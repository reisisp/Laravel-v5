<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::query()->where('id', '!=', Auth::id())->paginate(5);

        return view('admin.profiles.index')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $profiles)
    {
        return view('admin.profiles.create')->with('profiles', $profiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        return view('admin.profiles.create')->with('profiles', $profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profile)
    {
        $profile->delete();
        return redirect()->back()
            ->with('success', 'Пользователь успешно удален!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $result = $this->saveData($request, $profile);

        if ($result) {
            return redirect()
                ->route('admin.profiles.index')
                ->with('success', 'Профиль успешно изменен!');
        } else {
            $request->flash();
            return redirect()->route('admin.profiles.index')
                ->with('error', 'Ошибка изменения профиля!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profiles = new User();

        $result = $this->saveData($request, $profiles);

        if ($result) {
            return redirect()->route('admin.index')
                ->with('success', 'Пользователь успешно создан!');
        } else {
            $request->flash();
            return redirect()->route('admin.profiles.create')
                ->with('error', 'Ошибка добавления пользователя!');
        }
    }

    private function saveData(Request $request, User $profiles)
    {
        $this->validate($request, User::rules(), [], User::attributeNames());
        $request['password'] = Hash::make($request['password']);
        $profiles->fill($request->all());
        return $profiles->save();
    }

    public function toggleAdmin(User $profile)
    {
        if ($profile->id != Auth::id()) {
            $profile->is_admin = !$profile->is_admin;
            $profile->save();
            return redirect()->back()->with('success', 'Права изменены');
        } else {
            return redirect()->route('admin.profiles.index')->with('error', 'Ошибка');
        }
    }
}
