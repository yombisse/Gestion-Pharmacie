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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('poste');
            $table->string('telephone');
            $table->string('adresse');
            $table->enum('sexe',['homme','femme','personnalisee'])->nullable();
            $table->date('date_naissance');
            $table->dateTime('date_emploi');
            $table->decimal('salaire',10,2);
            $table->boolean('etat')->default(true);
            $table->string('photo');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
