<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    // Nom exact de la table
    protected $table = 'utilisateur';

    // Clé primaire
    protected $primaryKey = 'id_uti';

    // Champs autorisés en assignation massive
    protected $fillable = [
        'uti_nom',
        'uti_mdp',
        'email',
        'id_roles', // ajouter pour la relation
    ];

    // Champs masqués (par exemple pour les réponses JSON)
    protected $hidden = [
        'uti_mdp',
    ];

    // Relation avec Role (un utilisateur appartient à un rôle)
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_roles', 'id_role');
    }
}
