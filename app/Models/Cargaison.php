<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargaison extends Model
{
    use HasFactory;

    protected $table = 'cargaison';
    protected $primaryKey = 'id_cargaison';

    protected $fillable = [
        'date_extraction',
        'volume',
        'statut',
        'id_transport',
        'id_site',
        'id_uti'
    ];

    // Relation site
    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

    // Relation transport
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'id_transport');
    }

    // Relation utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_uti', 'id');
    }
}
