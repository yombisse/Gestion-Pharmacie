<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'produit_id',
        'client_id',     // pour la relation avec la table clients
        'client_nom',    // si tu veux aussi enregistrer le nom en clair
        'quantite_vente',
        'prix_total',
        'date_vente',
        
    ];
 
        protected $casts = [
            'date_vente' => 'datetime',
        ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public static function getMonthlySales()
{
    return self::selectRaw('MONTH(created_at) as month, SUM(prix_total) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month');
}
   
}

