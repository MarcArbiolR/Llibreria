<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llibre;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::orderBy('name'); // Ordenem les categories per nom
        $category = $query->paginate(5)->appends($request->query()); // Paginació de 5 categories per pàgina
        return view('crud.index', compact('category')); // Assegura't de tenir una vista 'llibre.index'
    }

    public function create()
    {
        $Categories = Category::all(); // Obtenim totes les categories
        return view('category.create', compact('Categories'));
    }

    public function new(Request $request)
    {
        // Valida les dades del formulari
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',  // Afegeix la validació d'unicitat
        ]);

        try {
            // Crea la categoria amb les dades validades
            $newCategory = Category::create([
                'name' => $request->name,
            ]);

            // Redirigeix a la llista de categories amb un missatge d'èxit
            return view('category.new', compact('newCategory'));
        } catch (\Exception $e) {
            // Maneig d'errors, per exemple, si la categoria ja existeix
            return back()->withErrors(['error' => 'Error al crear la categoria: ' . $e->getMessage()])->withInput();
        }
    }



    public function edit($id)
    {
        $category = Category::findOrFail($id); // Troba la categoria per ID o llança un error 404
        return view('llibre.edit', compact('category')); // Assegura't de tenir una vista 'llibre.edit'
    }

    public function update(Request $request, $id)
    {
        // Valida les dades del formulari
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string|max:255',
            'autor' => 'required|string|max:200',
            'any_publicacio' => 'required|integer|min:1900|max:' . date('Y'), // Validació de l'any de publicació
            'preu' => 'required|numeric|min:0', // Validació del preu
        ]);

        // Troba la categoria per ID i actualitza les dades
        $category = Category::findOrFail($id);
        $category->update($request->all());

        // Redirigeix a la llista de categories amb un missatge d'èxit
        return view('category.update', compact('category')); // Assegura't de tenir una vista 'llibre.update'
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id); // Troba la categoria per ID o llança un error 404
        $category->delete(); // Elimina la categoria
        return redirect()->route('category.index')->with('success', 'Categoria eliminada correctament!'); // Redirigeix a la llista de categories amb un missatge d'èxit
    }
}
