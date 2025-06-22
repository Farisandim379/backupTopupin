<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('topup_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('name'); // cth: "1050 Points"
            $table->unsignedInteger('price'); // cth: 100000
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('topup_items');
    }
};
