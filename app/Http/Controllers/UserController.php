<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        return view('create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->only(['name', 'email']));
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function show(User $user)
    {
        return view('show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->only(['name', 'email']));
        $user->save();

        return redirect()->route('index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('index')->with('success', 'Usuário excluído com sucesso!');
    }
}
