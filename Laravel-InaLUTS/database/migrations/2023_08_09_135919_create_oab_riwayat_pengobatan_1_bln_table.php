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
        Schema::create('oab_riwayat_pengobatan_1_bln', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('antihipertensi', 20)->default('');
            $table->string('antihipertensi_ya', 20)->default('');
            $table->string('obat_diabetik', 20)->default('');
            $table->string('obat_diabetik_ya', 20)->default('');
            $table->string('obat_obatan_psikiatri', 20)->default('');
            $table->string('obat_obatan_psikiatri_ya', 20)->default('');
            $table->string('obat_obatan_copd', 20)->default('');
            $table->string('obat_obatan_copd_ya', 20)->default('');
            $table->string('obat_obatan_asma', 20)->default('');
            $table->string('obat_obatan_asma_ya', 20)->default('');
            $table->string('obat_obatan_alergi', 20)->default('');
            $table->string('obat_obatan_alergi_ya', 20)->default('');
            $table->string('obat_obatan_saraf', 20)->default('');
            $table->string('obat_obatan_saraf_ya', 20)->default('');
            //===[ /FIELDS ]====================================================

            $table->timestamp('created_at')->useCurrent();
            $table->integer('created_user_id')->default(0);
            $table->integer('created_user_type')->default(0);
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->integer('updated_user_id')->default(0);
            $table->integer('updated_user_type')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_user_id')->default(0);
            $table->integer('deleted_user_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oab_riwayat_pengobatan_1_bln');
    }
};
