<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'user_id',
        'telephone',
        'adresse',
        'sexe',
        'date_naissance',
        'poste',
        'salaire',
        'date_emploi',
        'photo',
        'etat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($personnel) {
            if ($personnel->user) {
                $personnel->user->delete();
            }
        });
    }
}
