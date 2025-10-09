<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Kelas;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate class codes for existing classes that don't have one
        Kelas::whereNull('class_code')->each(function ($kelas) {
            do {
                $code = Str::random(6);
            } while (Kelas::where('class_code', $code)->exists());

            $kelas->update(['class_code' => $code]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally remove class codes, but this might not be desirable
        // Kelas::whereNotNull('class_code')->update(['class_code' => null]);
    }
};
