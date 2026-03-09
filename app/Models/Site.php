<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';
    protected $primaryKey = 'id_site';

    protected $fillable = [
        'nom',
        'localisation'
    ];

    // Relation avec les cargaisons du site
    public function cargaisons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Cargaison::class, 'id_site');
    }
}
