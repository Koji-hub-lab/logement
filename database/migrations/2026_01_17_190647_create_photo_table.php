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
    Schema::create('photo', function (Blueprint $table) {
        $table->id('id_photo');
        $table->unsignedBigInteger('id_logement');
        $table->string('url_photo', 255);
        $table->string('titre', 100)->nullable();
        $table->integer('ordre_affichage')->default(0);
        $table->timestamps();

        $table->foreign('id_logement')->references('id_logement')->on('logement')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo');
    }
};
