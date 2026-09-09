<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tokos MODIFY status ENUM('menunggu', 'aktif', 'nonaktif') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::statement("UPDATE tokos SET status = 'aktif' WHERE status = 'menunggu'");
        DB::statement("ALTER TABLE tokos MODIFY status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif'");
    }
};