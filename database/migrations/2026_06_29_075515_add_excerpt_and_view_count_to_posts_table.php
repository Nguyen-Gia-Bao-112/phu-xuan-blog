<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Thêm cột excerpt sau content
            $table->string('excerpt', 500)->nullable()->after('content');
            // Thêm cột view_count sau excerpt
            $table->integer('view_count')->default(0)->after('excerpt');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'view_count']);
        });
    }
};