<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable=[
        'user_id',
        'nom',
        'prenom',
        'sexe',
        'adresse',
        'telephone',
    ];
     public function vente(){

        return $this->hasMany(Vente::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }
}
