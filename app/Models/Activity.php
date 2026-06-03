<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model

{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titre',
        'description',

    ];
    public function messages()
    {
        return $this->hasMany(Message::class, 'actu_id', 'id');
    }

}
