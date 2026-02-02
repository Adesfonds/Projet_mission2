<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'role';

    // Clé primaire
    protected $primaryKey = 'id_role';

    // Les champs que l'on peut remplir en masse
    protected $fillable = [
        'libelle',
    ];

    // Relation avec les utilisateurs
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_roles', 'id_role');
    }
}
