<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('accounts');
    }
};
