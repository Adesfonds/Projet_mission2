<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $table = 'materiel';
    protected $primaryKey = 'id_materiel';

    protected $fillable = [
        'nom',
        'description',
        'stock',
        'seuil_alerte'
    ];

    // Relation avec les mouvements de stock
    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class, 'id_materiel');
    }

    // Relation pivot avec les commandes via la table "contenir"
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'contenir', 'id_materiel', 'id_commande')
            ->withPivot('quantite')
            ->withTimestamps();
    }
}
