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
    Schema::create('reservation', function (Blueprint $table) {
        $table->id('id_reservation');
        $table->unsignedBigInteger('id_utilisateur');
        $table->unsignedBigInteger('id_logement');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->decimal('prix_total', 10, 2);
        $table->enum('statut', ['en_attente', 'confirmee', 'annulee', 'terminee'])->default('en_attente');
        $table->date('date_creation')->useCurrent();
        $table->text('commentaire')->nullable();
        $table->timestamps();

        $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
        $table->foreign('id_logement')->references('id_logement')->on('logement');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
