<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('topup_items', function (Blueprint $table) {
            // Menambahkan kolom 'image' setelah kolom 'price'
            $table->string('image')->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('topup_items', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
