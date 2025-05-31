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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->dateTime('date_commande');
            $table->decimal('total_prix_commande',10,2);
            $table->enum('statut',['en_entente','en_livraison','livree'])->default('en_entente');

            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
