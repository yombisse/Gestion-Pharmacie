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
        'eta',
        'image',
    ];
    public function ventes()
{
    return $this->belongsToMany(Commande::class, 'commandes_produits', 'produit_id', 'commande_id')
                ->withPivot('quantite','prix_unitaire','sous_total') // adapte selon les colonnes que tu as
                ->withTimestamps();
}

    public function commande(){
        return $this->belongsToMany(Commande::class,'commandes_produits')->withPivot('quantite','prix_unitaire','sous_total')->withTimestamps();
    }

    public static function getTopSellingProducts($limit = 5)
{
    return self::withCount('ventes')
        ->orderBy('ventes_count', 'desc')
        ->limit($limit)
        ->get();
}
}
