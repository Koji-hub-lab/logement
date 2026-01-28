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
    Schema::create('message', function (Blueprint $table) {
        $table->id('id_message');
        $table->unsignedBigInteger('id_expediteur');
        $table->unsignedBigInteger('id_destinataire');
        $table->unsignedBigInteger('id_logement')->nullable();
        $table->string('sujet', 255);
        $table->text('contenu');
        $table->boolean('lu')->default(false);
        $table->dateTime('date_envoi')->useCurrent();
        $table->timestamps();

        $table->foreign('id_expediteur')->references('id_utilisateur')->on('utilisateur');
        $table->foreign('id_destinataire')->references('id_utilisateur')->on('utilisateur');
        $table->foreign('id_logement')->references('id_logement')->on('logement')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
