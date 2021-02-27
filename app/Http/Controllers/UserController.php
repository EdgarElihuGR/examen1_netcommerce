<?php

namespace App\Http\Controllers;

use App\Models\{User, Role};
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Declaration of vars in order to use the same form template
        $user = new User;
        $title = "Nuevo Usuario";
        $txtButton = "Agregar";
        $route = route('users.store');
        $roles = Role::pluck('title', 'id');
        return view('users.create', compact('user','title','txtButton','route','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:80|string',
            'email' => 'required|unique:users',
            'password' => 'required',
            'roles.*' => 'integer',
            'roles' => 'required|array',
        ]);

        //Save validated fields to user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        //Save roles to user
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Declaration of vars in order to use the same form template
        $update = true;
        $title = "Actualizar Usuario";
        $txtButton = "Actualizar";
        $route = route('users.update',['user' => $user]);
        $roles = Role::pluck('title', 'id');
        $user->load('roles');

        return view('users.edit', compact('user','title','txtButton','route','update','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:80|string',
            'email' => 'required|unique:users,email,' . $user->id,
            'roles.*' => 'integer',
            'roles' => 'required|array',
        ]);

        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
