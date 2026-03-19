<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->string('adresse');
            $table->string('ville');
            $table->integer('nb_chambres');
            $table->integer('nb_salles_bain');
            $table->decimal('superficie', 8, 2)->nullable();
            $table->boolean('wifi')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('climatisation')->default(false);
            $table->enum('statut', ['disponible', 'loué'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logements');
    }
};