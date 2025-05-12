<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;
use App\Models\Category;

class CategoryController extends Controller
{
    public function manage(Request $request)
    {
        $query = Category::orderBy('name'); // Ordenem les categories per nom
        $categories = $query->paginate(10); // Paginació de 5 categories per pàgina
        return view('category.manage', compact('categories')); // Retorna la vista
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
        return view('category.edit', compact('category')); // Assegura't de tenir una vista 'categoria.edit'
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoria = Category::findOrFail($id);

        try {
            $categoria->update($validated);
        } catch (\Exception $e) {
            return redirect()
                ->route('category.edit', $id) // <- redirigeix cap a "edit"
                ->with('error', 'Aquest nom de categoria ja existeix.');
        }

        return redirect()
            ->route('category.manage')
            ->with('success', 'Categoria actualitzada correctament.');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.manage');
    }
}
