<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logement_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->enum('statut', ['en_attente', 'acceptée', 'refusée'])->default('en_attente');
            $table->text('message_client')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};