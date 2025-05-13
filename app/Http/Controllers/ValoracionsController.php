<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llibre; // Afegim el model Llibre

class ValoracionsController extends Controller
{
    public function create($llibreId, $usuariId)
    {
        // Recuperem el llibre amb l'ID passat
        $llibre = Llibre::findOrFail($llibreId);  // Recuperem el llibre a partir de la seva ID

        // Aquí passes el llibre i l'usuari a la vista
        return view('valoracions.create', compact('llibre', 'usuariId', 'llibreId'));
    }


    public function new(Request $request)
    {
        // Validació de les dades rebudes
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'llibre_id' => 'required|integer|exists:llibres,id',
            'nota' => 'required|integer|min:1|max:5',
            'valoracio' => 'required|string|max:1000',
        ]);

        // Desar la valoració a la base de dades
        \App\Models\Valoracio::create([
            'usuari_id' => $validated['user_id'],
            'llibre_id' => $validated['llibre_id'],
            'puntuacio' => $validated['nota'],
            'comentari' => $validated['valoracio'],
        ]);

        // Redirecció a la vista del llibre concret
        return redirect()->route('crud.show', ['id' => $validated['llibre_id']])
            ->with('success', 'Valoració creada correctament!');
    }
}
