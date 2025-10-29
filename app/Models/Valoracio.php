<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracio extends Model
{
    use HasFactory;
    protected $table = 'llibre_user'; // Nom de la taula a la base de dades

    protected $fillable = [
        'id',
        'user_id',
        'llibre_id',
        'nota',
        'valoracio',
        'created_at',
        'updated_at'
    ];

    // Relació amb l'usuari
    public function usuari()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relació amb el llibre
    public function llibre()
    {
        return $this->belongsTo(Llibre::class);
    }
}
