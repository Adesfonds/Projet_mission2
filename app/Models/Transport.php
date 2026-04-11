<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table = 'transport';
    protected $primaryKey = 'id_transport';

    protected $fillable = [
        'date_depart',
        'date_arrivee',
        'destination',
        'statut_transport'
    ];

    // Relation avec les cargaisons transportées
    public function cargaisons()
    {
        return $this->belongsTo(Cargaison::class, 'id_cargaison');
    }
}
