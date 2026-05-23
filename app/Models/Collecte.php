<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    protected $table = 'collecte_';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_capt',
        'id_mesure_',
    ];

    public function capteur()
    {
        return $this->belongsTo(Capteur::class, 'id_capt', 'id_capt');
    }

    public function mesure()
    {
        return $this->belongsTo(Mesure::class, 'id_mesure_', 'id_mesure_');
    }
}
