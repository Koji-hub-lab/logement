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
    Schema::create('favoris', function (Blueprint $table) {
        $table->id('id_favori');
        $table->unsignedBigInteger('id_utilisateur');
        $table->unsignedBigInteger('id_logement');
        $table->date('date_ajout')->useCurrent();
        $table->timestamps();

        $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');
        $table->foreign('id_logement')->references('id_logement')->on('logement')->onDelete('cascade');
        
        $table->unique(['id_utilisateur', 'id_logement']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoris');
    }
};
