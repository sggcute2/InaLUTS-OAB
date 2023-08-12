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
        Schema::create('oab_riwayat_radiasi', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('riwayat_radiasi_pelvis', 5)->default('');
            $table->tinyInteger('c_riwayat_radiasi_pelvis_keganasan_saluran_kemih')->default(0);
            $table->tinyInteger('c_riwayat_radiasi_pelvis_keganasan_saluran_cerna')->default(0);
            $table->tinyInteger('c_riwayat_radiasi_pelvis_keganasan_ginekologi')->default(0);
            $table->string('riwayat_kemoterapi', 5)->default('');
            $table->tinyInteger('c_riwayat_kemoterapi_keganasan_saluran_kemih')->default(0);
            $table->tinyInteger('c_riwayat_kemoterapi_keganasan_saluran_cerna')->default(0);
            $table->tinyInteger('c_riwayat_kemoterapi_keganasan_ginekologi')->default(0);
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
        Schema::dropIfExists('oab_riwayat_radiasi');
    }
};
