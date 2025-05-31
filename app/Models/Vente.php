<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    //
    protected $fillable = [
        'produit_id',
        'quantite_vente',
        'prix_total',
        'client_nom',
        'date_vente',
        
    ];
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function produit(){
       return $this->belongsTo(Produit::class);
    }

}
