<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    protected $table = 'Mesure_';
    protected $primaryKey = 'id_mesure_';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mesure_',
        'horodatage',
        'valeur',
        'unite',
    ];
}
