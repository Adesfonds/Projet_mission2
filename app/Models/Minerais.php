<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minerais extends Model
{
    // Table associée (optionnel si le nom suit la convention)
    protected $table = 'minerais';

    // Champs modifiables en masse (mass assignable)
    protected $fillable = [
        'nom',
        'description',
        'densite',
    ];

    /**
     * Relation : un minerai peut être transporté par plusieurs cargaisons
     */
    public function cargaisons()
    {
        return $this->hasMany(Cargaison::class, 'id_minerais');
    }
}
