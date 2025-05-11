<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Els atributs assignables massivament.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'data_naixement',
    ];

    /**
     * Els atributs amagats en serialització.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversió de tipus per a certs atributs.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'data_naixement' => 'date',
        ];
    }

    /**
     * Relació: llibres que ha valorat aquest usuari.
     */
    public function llibresValorats(): BelongsToMany
    {
        return $this->belongsToMany(Llibre::class, 'llibre_user')
            ->withPivot('nota', 'valoracio')
            ->withTimestamps();
    }

    /**
     * Relació: llibres creats per aquest usuari.
     */
    public function llibres(): HasMany
    {
        return $this->hasMany(Llibre::class);
    }

    /**
     * Accessor: edat de l’usuari segons la data de naixement.
     */
    public function getEdatAttribute(): ?int
    {
        // Retorna la diferència en anys entre la data actual i la data de naixement
        return $this->data_naixement ? $this->data_naixement->diffInYears(now()) : null;
    }
}
