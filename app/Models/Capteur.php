<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capteur extends Model
{
    protected $table = 'capteur_';
    protected $primaryKey = 'id_capt';


    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_capt',
        'type_capteur',
        'modele_',
        'fabricant',
        'localisation',
        'unite_mesure',
        'date_mise_service_',
        'seuil_min',
        'seuil_max',
    ];
}
