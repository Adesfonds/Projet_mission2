<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{
    use HasFactory;

    protected $table = 'mouvement_stock';
    protected $primaryKey = 'id_mouvement';

    protected $fillable = [
        'id_uti',
        'id_materiel',
        'date_mouvement',
        'type_mouvement',
        'quantite'
    ];

    // Relation vers l'utilisateur qui effectue le mouvement
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_uti');
    }

    // Relation vers le matériel concerné par le mouvement
    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel');
    }
}
