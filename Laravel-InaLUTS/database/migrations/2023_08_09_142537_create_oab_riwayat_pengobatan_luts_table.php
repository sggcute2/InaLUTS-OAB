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
        Schema::create('oab_riwayat_pengobatan_luts', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('tamsulosin', 5)->default('');
            $table->integer('tamsulosin_hari')->default(0);
            $table->integer('tamsulosin_bulan')->default(0);
            $table->integer('tamsulosin_tahun')->default(0);
            $table->string('alfuzosin', 5)->default('');
            $table->integer('alfuzosin_hari')->default(0);
            $table->integer('alfuzosin_bulan')->default(0);
            $table->integer('alfuzosin_tahun')->default(0);
            $table->string('doxazosin', 5)->default('');
            $table->integer('doxazosin_hari')->default(0);
            $table->integer('doxazosin_bulan')->default(0);
            $table->integer('doxazosin_tahun')->default(0);
            $table->string('terazosin', 5)->default('');
            $table->integer('terazosin_hari')->default(0);
            $table->integer('terazosin_bulan')->default(0);
            $table->integer('terazosin_tahun')->default(0);
            $table->string('silodosin', 5)->default('');
            $table->integer('silodosin_hari')->default(0);
            $table->integer('silodosin_bulan')->default(0);
            $table->integer('silodosin_tahun')->default(0);
            $table->string('finasteride', 5)->default('');
            $table->integer('finasteride_bulan')->default(0);
            $table->string('dutasteride')->default(0);
            $table->integer('dutasteride_bulan')->default(0);
            $table->string('pde_5_inhibitor', 5)->default('');
            $table->string('tadalafil', 5)->default('');
            $table->integer('tadalafil_bulan')->default(0);
            $table->string('solifenacin', 5)->default('');
            $table->integer('solifenacin_bulan')->default(0);
            $table->string('imidafenacin', 5)->default('');
            $table->integer('imidafenacin_bulan')->default(0);
            $table->string('tolterodine', 5)->default('');
            $table->integer('tolterodine_bulan')->default(0);
            $table->string('propiverine', 5)->default('');
            $table->integer('propiverine_bulan')->default(0);
            $table->string('flavoxate', 5)->default('');
            $table->integer('flavoxate_bulan')->default(0);
            $table->string('mirabegron', 5)->default('');
            $table->integer('mirabegron_bulan')->default(0);
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
        Schema::dropIfExists('oab_riwayat_pengobatan_luts');
    }
};
