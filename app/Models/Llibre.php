<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Llibre extends Model
{
    protected $table = 'llibre'; // Nom de la taula a la base de dades
    protected $fillable = [
        'titol',
        'autor',
        'resum',
        'data_publicacio',
        'preu',
        'imatge',
        'edat_minima',
        'categoria_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
    public function valoracions()
    {
        return $this->belongsToMany(User::class, 'llibre_user')
            ->withPivot('nota', 'valoracio')
            ->withTimestamps();
    }
}
