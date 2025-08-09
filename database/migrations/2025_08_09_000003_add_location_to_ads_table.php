<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete()->after('user_id');
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete()->after('province_id');
        });
    }

    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropConstrainedForeignId('province_id');
            $table->dropConstrainedForeignId('district_id');
        });
    }
};


