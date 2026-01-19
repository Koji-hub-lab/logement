<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('id_utilisateur');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('email')->unique();
            $table->string('telephone', 20)->nullable();
            $table->string('password');
            $table->enum('role', ['client', 'bailleur'])->default('client');
            $table->rememberToken();
            $table->timestamps(); // Ceci crée created_at et updated_at automatiquement
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};