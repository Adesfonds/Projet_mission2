<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';
    protected $primaryKey = 'id_message';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'message',
        'actu_id'
    ];

    // Relation correcte
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'actu_id', 'id');
    }
}
