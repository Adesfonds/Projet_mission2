<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $primaryKey = 'id_commande';

    protected $fillable = [
        'date_commande',
        'statut_commande',
        'id_fournisseur'
    ];

    // Relation avec le fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    // Relation avec les matériels via la table pivot "contenir"
    public function materiels()
    {
        return $this->belongsToMany(Materiel::class, 'contenir', 'id_commande', 'id_materiel')
            ->withPivot('quantite')
            ->withTimestamps();
    }
}
