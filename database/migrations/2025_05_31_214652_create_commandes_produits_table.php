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
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_commande');
            $table->decimal('prix_unitaire', 10, 2)->default(0);
            $table->decimal('sous_total', 10, 2)->default(0);
            $table->integer('quantite')->unsigned();
            $table->enum('statut', ['en_entente', 'en_livraison', 'livree'])->default('en_entente');
            $table->timestamps();

            // Pour éviter les doublons
            $table->unique(['commande_id', 'produit_id']);
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
