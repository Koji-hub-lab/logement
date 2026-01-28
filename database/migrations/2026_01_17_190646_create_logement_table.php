<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('logement', function (Blueprint $table) {
        $table->id('id_logement');
        $table->unsignedBigInteger('id_utilisateur');
        $table->string('titre', 100);
        $table->text('description');
        $table->decimal('prix', 10, 2);
        $table->string('adresse', 255);
        $table->string('ville', 100);
        $table->string('pays', 100);
        $table->string('code_postal', 10);  // Changé de integer à string
        $table->integer('superficie');
        $table->integer('nombre_pieces');
        $table->integer('nombre_chambres');
        $table->enum('type', ['appartement', 'maison', 'studio', 'villa']);
        $table->boolean('meuble')->default(false);
        $table->date('date_disponibilite');
        $table->enum('statut', ['disponible', 'loue', 'indisponible'])->default('disponible');
        $table->timestamps();

        $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logement');
    }
};
