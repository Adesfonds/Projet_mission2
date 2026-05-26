<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithDictionary;

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
        'id_uti',
        'id_minerais'
    ];

    // Relation site
    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

    // Relation transport
    public function transport()
    {
        return $this->belongsTo(
            Transport::class,
            'id_transport',
            'id_transport'
        );
    }

    // Relation utilisateur
    public function users()
    {
        return $this->belongsTo(User::class, 'id_uti', 'id');
    }
    // Cargaison.php
    public function minerais()
    {
        return $this->belongsTo(Minerais::class, 'id_minerais');
    }
}
