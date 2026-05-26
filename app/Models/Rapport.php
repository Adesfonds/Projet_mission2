<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $table = 'rapports';

    protected $fillable = [
        'titre',
        'contenu',
        'type',
        'date_rapport',
        'fichier',
    ];
}
