<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Llibre; // Assegura't que tens aquest model

class edat
{
    public function handle(Request $request, Closure $next)
    {
        $llibreId = $request->route('id'); // Assumim que el llibre ve per la ruta
        $llibre = Llibre::find($llibreId);

        if (!$llibre) {
            abort(404, 'Llibre no trobat');
        }

        $usuari = $request->user(); // Assumim que l'usuari està autenticat
        if (!$usuari || $usuari->edat < $llibre->edat_minima) {
            session()->flash('error', 'No tens la edat per accedir a aquest llibre.');

            return redirect('/'); // O on vulguis redirigir

        }

        return $next($request);
    }
}
