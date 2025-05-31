<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vente;

class Produit extends Model
{
    //
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'quantite',
        'categorie',
        'date_expiration',
        'etat',
        'photo_produit',
    ];
    public function vente(){

        return $this->hasMany(Vente::class);
    }
    public function commande(){
        return $this->belongsToMany(Commande::class,'commandes_produits')->withPivot('quantite','prix_unitaire','sous_total')->withTimestamps();
    }
}
