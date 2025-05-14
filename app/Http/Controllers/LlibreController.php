<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llibre;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Valoracio;

use function Laravel\Prompts\alert;

class LlibreController extends Controller
{
    public function index(Request $request)
    {
        $category = null;

        $query = Llibre::with('category'); // Obtenim tots els llibres amb la seva categoria

        // Si hi ha categoria
        if ($request->has('categoria')) {
            $category = Category::find($request->get('categoria'));
            if ($category) {
                $query->where('categoria_id', $category->id);
            }
        }



        $user = Auth::user();
        if (!$user) {
            abort(401, 'No autenticat');
        }

        $edat = $user->edat;
        $dataNaixement = $user->data_naixement;

        $llibres = $query->paginate(12);

        return view('crud.index', compact('llibres', 'category', 'dataNaixement', 'edat'));
    }


    public function create()
    {
        $categories = Category::all(); // Obtenim totes les categories per al formulari de creació
        return view('crud.create', compact('categories'));
    }

    public function edit($id)
    {
        // Aquí pots afegir la lògica per mostrar el formulari d'edició de llibres
        // Obtenim el llibre per ID
        $llibre = Llibre::with('category')->findOrFail($id); // Assegura't de tenir el model Llibre importat.

        $categories = Category::all(); // Obtenim totes les categories per al formulari d'edició
        return view('crud.edit', compact('llibre', 'categories')); // Assegura't de tenir una vista 'llibre.edit'

    }



    public function update(Request $request, $id)
    {
        // Validació de les dades
        $validated = $request->validate([
            'titol' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'resum' => 'required|string',
            'data_publicacio' => 'required|date',
            'preu' => 'required|numeric|min:0',
            'edat_minima' => 'required|integer|min:0',
            'categoria_id' => 'required|integer|exists:categories,id',
            'imatge' => 'nullable|string|max:2048',
        ]);

        // Buscar el llibre per ID
        $llibre = Llibre::findOrFail($id);

        // Actualitzar el llibre
        $llibre->update($validated);

        // Obtenir la categoria per mostrar-la si cal
        $categoria = Category::findOrFail($llibre->categoria_id);


        // Redirigir o retornar una vista amb el llibre actualitzat
        return redirect()
            ->route('crud.show', $llibre->id)
            ->with('success', 'Llibre actualitzat correctament');
    }


    public function show($id)
    {
        // Carreguem el llibre amb les seves valoracions i la categoria
        $llibre = Llibre::with(['llibresValorats', 'category'])->findOrFail($id);
        $categoria = Category::findOrFail($llibre->categoria_id);

        // Comprovar si l'usuari autenticat ha valorat el llibre
        $hasValoracio = Auth::check() && $llibre->llibresValorats()
            ->where('user_id', Auth::id())
            ->exists();

        return view('crud.show', compact('llibre', 'categoria', 'hasValoracio'));
    }
    public function delete($id)
    {
        // Troba el llibre i l'esborra
        $llibre = Llibre::findOrFail($id);
        $llibre->delete();

        // Redirigeix a la llista de llibres amb un missatge d'èxit
        return redirect()->route('crud.index')->with('success', 'Llibre esborrat correctament!');
    }
    public function new(Request $request)
    {
        // Validació de les dades
        $validated = $request->validate([
            'titol' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'resum' => 'required|string',
            'data_publicacio' => 'required|date',
            'preu' => 'required|numeric|min:0',
            'edat_minima' => 'required|integer|min:0',
            'categoria_id' => 'required|integer|exists:categories,id',
            'imatge' => 'nullable|string|max:2048',
        ]);

        // Creació del llibre
        $newLlibre = Llibre::create([
            'titol' => $request->titol,
            'autor' => $request->autor,
            'resum' => $request->resum,
            'data_publicacio' => $request->data_publicacio,
            'preu' => $request->preu,
            'edat_minima' => $request->edat_minima,
            'categoria_id' => $request->categoria_id,
            'imatge' => $request->imatge,
        ]);

        $categoria = Category::findOrFail($newLlibre->categoria_id); // Obtenim la categoria associada al llibre.

        // Redirigir a la vista amb el llibre creat
        return view('crud.new', compact('newLlibre', 'categoria'));
    }
}
