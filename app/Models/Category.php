<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nom de la taula a la base de dades
    protected $fillable = [
        'name'
    ];

    public function llibres()
    {
        return $this->hasMany(Llibre::class);
    }
}
