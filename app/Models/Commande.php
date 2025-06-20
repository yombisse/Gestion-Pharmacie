<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_commande',
        'prix_total_commande',
        'statut',
    ];
    public function client()
{
    return $this->belongsTo(Client::class);
}

    
    // Relation au pluriel car une commande peut avoir plusieurs produits
    public function produits() {
        return $this->belongsToMany(Produit::class, 'commandes_produits')
                   ->withPivot('quantite', 'prix_unitaire', 'sous_total')
                   ->withTimestamps();
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
        public function vente()
    {
        return $this->hasOne(Vente::class);
    }

}