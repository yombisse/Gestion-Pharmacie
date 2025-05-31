<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
    protected $fillable=[
        'client_id',
        'date_commande',
        'prix_total_commande',
        'statut',
    ];
    public function produit(){
        return $this->belongsToMany(Produit::class,'commandes_produits')->withPivot('quantite','prix_unitaire','sous_total')->withTimestamps();
    }
    
}
