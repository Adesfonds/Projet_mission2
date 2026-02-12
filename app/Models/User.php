<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateur';
    protected $primaryKey = 'id_uti';

    protected $fillable = [
        'uti_nom',
        'uti_mdp',
        'email',
        'id_roles',
    ];

    protected $hidden = [
        'uti_mdp',
    ];

    // 👇 IMPORTANT pour que Auth fonctionne
    public function getAuthPassword()
    {
        return $this->uti_mdp;
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_roles', 'id_role');
    }

    public function isAdmin()
    {
        return $this->role && $this->role->libelle === 'Admin';
    }

    protected function casts(): array
    {
        return [
            'uti_mdp' => 'hashed',
        ];
    }

}

