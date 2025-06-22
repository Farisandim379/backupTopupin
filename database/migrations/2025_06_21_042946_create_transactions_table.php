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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_code')->unique();

            // Detail Game
            $table->string('game_name'); // Nama game, cth: "Valorant"
            $table->string('game_user_id');
            // DIUBAH: Dibuat nullable agar game tanpa server tidak error
            $table->string('game_server')->nullable();

            // Detail Pembelian
            $table->string('nominal_amount');
            $table->unsignedInteger('price');
            $table->string('payment_method');
            $table->string('whatsapp_number')->nullable();

            // Status Transaksi
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
