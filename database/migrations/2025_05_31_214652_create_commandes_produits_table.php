<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes_produits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('produit_id');
            $table->dateTime('date_commande');
            $table->decimal('prix_unitaire',10,2);
            $table->decimal('sous_total',10,2);
            $table->integer('quantite');
            $table->enum('statut',['en_entente','en_livraison','livree'])->default('en_entente');
            $table->timestamps();
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes_produits');
    }
};
