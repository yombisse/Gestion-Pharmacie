<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Client;
use App\Models\Personnelt;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relations
    public function personnel()
    {
        return $this->hasOne(Personnel::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ? asset($this->avatar)
            : asset('uploads/images/avatar.jpg');
    }

    
}


