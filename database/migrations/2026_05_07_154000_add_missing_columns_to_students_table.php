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
        if (!Schema::hasColumn('students', 'tanggal_lahir')) {
            Schema::table('students', function (Blueprint $table) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            });
        }

        if (!Schema::hasColumn('students', 'id_info')) {
            Schema::table('students', function (Blueprint $table) {
                $table->integer('id_info')->nullable()->after('id_baju');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'tanggal_lahir')) {
                $table->dropColumn('tanggal_lahir');
            }
            if (Schema::hasColumn('students', 'id_info')) {
                $table->dropColumn('id_info');
            }
        });
    }
};
