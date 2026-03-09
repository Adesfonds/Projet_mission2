<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenir extends Model
{
    use HasFactory;

    protected $table = 'contenir';
    public $incrementing = false; // pas d'id auto-incrément
    public $timestamps = true;    // si tu as timestamps dans ta table

    protected $fillable = [
        'id_materiel',
        'id_commande',
        'quantite'
    ];

    // Relation vers Materiel
    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel');
    }

    // Relation vers Commande
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}
