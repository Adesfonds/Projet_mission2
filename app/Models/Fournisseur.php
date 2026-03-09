<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $table = 'fournisseur';
    protected $primaryKey = 'id_fournisseur';

    protected $fillable = [
        'nom',
        'telephone',
        'email'
    ];

    // Relation avec les commandes passées par ce fournisseur
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'id_fournisseur');
    }
}
