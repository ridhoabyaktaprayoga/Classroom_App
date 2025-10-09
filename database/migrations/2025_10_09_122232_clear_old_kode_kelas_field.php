<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Kelas;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First make the kode_kelas field nullable
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('kode_kelas')->nullable()->change();
        });

        // Then clear the old kode_kelas field since we're now using class_code
        Kelas::whereNotNull('kode_kelas')->update(['kode_kelas' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is not reversible as it clears data
        // In a real scenario, you might want to restore from backups
    }
};
