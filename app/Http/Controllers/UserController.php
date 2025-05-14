<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // Registre d'usuari
    public function registar()
    {
        return view('users.register');
    }
    // Desar un nou usuari
    public function registrat(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'password' => 'required|string|min:8|confirmed',
            'data_naixement' => 'required|date',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->data_naixement = $validated['data_naixement'];
        $user->save();

        return redirect()->route('login')->with('success', 'Usuari creat correctament.');
    }
    // Llista d'usuaris
    public function manage()
    {
        $users = User::all();
        return view('users.manage', compact('users'));
    }

    // Formulari de creació
    public function create()
    {
        return view('users.create');
    }

    // Desar un usuari nou
    public function new(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'password' => 'required|string|min:8|confirmed',
            'data_naixement' => 'required|date',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->data_naixement = $validated['data_naixement'];
        $user->save();

        return redirect()->route('users.manage')->with('success', 'Usuari creat correctament.');
    }


    // Formulari d'edició
    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'data_naixement' => 'required|date',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->data_naixement = $validated['data_naixement'];

        $user->save();

        return redirect()->route('users.manage')->with('success', 'Usuari actualitzat correctament.');
    }


    // Eliminar usuari
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.manage')->with('success', 'Usuari eliminat correctament.');
    }
}
