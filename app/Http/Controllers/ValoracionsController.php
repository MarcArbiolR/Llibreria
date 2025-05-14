<?php

namespace App\Http\Controllers;

use App\Models\Llibre;
use App\Models\Valoracio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValoracionsController extends Controller
{
    public function create($llibreId, $usuariId)
    {
        // Comprovem que l'usuari autenticat coincideixi amb l'usuariId
        if (Auth::id() != $usuariId) {
            return redirect()->back()->with('error', 'No tens permís per valorar aquest llibre.');
        }

        // Comprovar si l'usuari ja ha valorat aquest llibre
        $hasValoracio = Valoracio::where('user_id', $usuariId)
            ->where('llibre_id', $llibreId)
            ->exists();

        if ($hasValoracio) {
            return redirect()->route('crud.show', $llibreId)
                ->with('error', 'No pots crear una nova valoració perquè ja n\'has fet una.');
        }

        // Recuperem el llibre amb l'ID passat
        $llibre = Llibre::findOrFail($llibreId);

        // Passem el llibre i l'usuari a la vista
        return view('valoracions.create', compact('llibre', 'usuariId', 'llibreId'));
    }

    public function new(Request $request)
    {
        // Validem que l'usuari autenticat coincideixi amb el user_id enviat
        if (Auth::id() != $request->input('user_id')) {
            return redirect()->back()->with('error', 'No pots crear una valoració per a un altre usuari.');
        }

        // Comprovar si l'usuari ja ha valorat aquest llibre
        $hasValoracio = Valoracio::where('user_id', $request->input('user_id'))
            ->where('llibre_id', $request->input('llibre_id'))
            ->exists();

        if ($hasValoracio) {
            return redirect()->route('crud.show', $request->input('llibre_id'))
                ->with('error', 'No pots crear una nova valoració perquè ja n\'has fet una.');
        }

        // Validació de les dades rebudes
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'llibre_id' => 'required|integer|exists:llibre,id',
            'nota' => 'required|integer|min:1|max:10',
            'valoracio' => 'required|string|max:1000',
        ]);

        // Desar la valoració a la base de dades
        Valoracio::create([
            'user_id' => $validated['user_id'],
            'llibre_id' => $validated['llibre_id'],
            'nota' => $validated['nota'],
            'valoracio' => $validated['valoracio'],
        ]);

        // Redirecció a la vista del llibre concret
        return redirect()->route('crud.show', $validated['llibre_id'])
            ->with('success', 'Valoració creada correctament!');
    }
}
