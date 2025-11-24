<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            if (!Schema::hasColumn('toko', 'user_id')) {
                $table->foreignId('user_id')
                      ->constrained('users')
                      ->onDelete('cascade')
                      ->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            if (Schema::hasColumn('toko', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
