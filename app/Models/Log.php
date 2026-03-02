<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_logs';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'action',
        'ip_adresse',
        'id_uti',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_uti', 'id');
    }
}
