<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargaison extends Model
{
    use HasFactory;

    protected $table = 'cargaison';          // nom de la table
    protected $primaryKey = 'id_cargaison';  // clé primaire

    protected $fillable = [
        'date_extraction',
        'volume',
        'statut',
        'id_transport',
        'id_site',
        'id_uti'
    ];

    // Relation avec le site
    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

    // Relation avec le transport
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'id_transport');
    }

    // Relation avec l'utilisateur
    public function users()
    {
        return $this->belongsTo(User::class, 'id_uti', 'id');
    }
}
