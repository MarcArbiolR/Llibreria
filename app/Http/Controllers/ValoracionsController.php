<?php

namespace App\Http\Controllers;

use App\Models\Llibre;
use App\Models\Valoracio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {
            // Validem que l'usuari autenticat coincideixi amb el user_id enviat
            if (Auth::id() != $request->input('user_id')) {
                return response()->json([
                    'success' => false,
                    'error' => 'No pots crear una valoració per a un altre usuari.'
                ], 403);
            }

            // Comprovar si l'usuari ja ha valorat aquest llibre
            $hasValoracio = Valoracio::where('user_id', $request->input('user_id'))
                ->where('llibre_id', $request->input('llibre_id'))
                ->exists();

            if ($hasValoracio) {
                return response()->json([
                    'success' => false,
                    'error' => 'No pots crear una nova valoració perquè ja n\'has fet una.'
                ], 400);
            }

            // Validació de les dades rebudes
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'llibre_id' => 'required|integer|exists:llibre,id',
                'nota' => 'required|integer|min:1|max:10',
                'valoracio' => 'required|string|max:1000',
            ]);

            // Desar la valoració a la base de dades
            $valoracio = new Valoracio();
            $valoracio->user_id = $validated['user_id'];
            $valoracio->llibre_id = $validated['llibre_id'];
            $valoracio->nota = $validated['nota'];
            $valoracio->valoracio = $validated['valoracio'];
            $valoracio->save();

            // Obtenir les dades necessàries per actualitzar la vista
            $user = Auth::user();
            $estrelles = round($valoracio->nota / 2);

            return response()->json([
                'success' => true,
                'message' => 'Valoració creada correctament!',
                'valoracio' => [
                    'userName' => $user->name,
                    'data' => now()->format('d/m/Y'),
                    'nota' => $valoracio->nota,
                    'estrelles' => $estrelles,
                    'text' => $valoracio->valoracio,
                    'id' => $valoracio->id
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Hi ha hagut un error en crear la valoració: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $valoracio = Valoracio::findOrFail($id);
            
            // Verificar que el usuario autenticado es el propietario de la valoración
            if (Auth::id() != $valoracio->user_id) {
                return response()->json([
                    'success' => false,
                    'error' => 'No tienes permiso para eliminar esta valoración'
                ], 403);
            }
            
            $deleted = $valoracio->delete();
            
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Valoració eliminada correctament!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'No s\'ha pogut trobar la valoració amb ID: ' . $id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar valoració: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error al eliminar la valoració. ID: ' . $id . '. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
