<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus semua data dari tabel tanggapans dan laporans
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('tanggapans')->truncate();
        DB::table('laporans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada tindakan rollback yang diperlukan untuk truncate
    }
};
