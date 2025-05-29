<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = auth()->user()->hasRole('secre') 
            ? Role::where('name', '!=', 'admin')->get()
            : Role::all();

        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'rol' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->rol);

        return redirect()->route('usuarios.index');
    }

    public function edit(User $user)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);
        $roles = Role::all();
        return view('usuarios.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|exists:roles,name',
        ]);

        $user->update($request->only('name', 'email'));
        $user->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index');
    }

    public function destroy(User $user)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);
        $user->delete();

        return redirect()->route('usuarios.index');
    }

    public function asignarRolVista()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $usuarios = User::with('roles')->get();
        $roles = Role::all();

        return view('usuarios.asignar-rol', compact('usuarios', 'roles'));
    }

    public function asignarRol(Request $request)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rol' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->syncRoles([$request->rol]);

        return back()->with('success', 'Rol asignado correctamente.');
    }
}

//poner admin con tinker
// php artisan tinker
// $user = App\Models\User::find(1);
// $user->assignRole('admin');
// $user->assignRole('secre');
// $user->assignRole('bodega');