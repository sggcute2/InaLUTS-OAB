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
        Schema::create('oab_follow_up_detail', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->integer('follow_up_id')->default(0);

            $table->string('oabss', 5)->default('');
            $table->text('oabss_ya')->default('a:0:{}');
            $table->string('qol', 5)->default('');
            $table->text('qol_ya')->default('a:0:{}');
            $table->text('bladder_diary')->default('a:0:{}');

            $table->string('mulut_kering', 5)->default('');
            $table->string('mata_kering', 5)->default('');
            $table->string('konstipasi', 5)->default('');
            $table->string('gejala_voiding', 5)->default('');
            $table->string('gangguan_fungsi_kognitif', 5)->default('');
            $table->string('retensi_urine', 5)->default('');
            $table->string('hipertensi', 5)->default('');
            $table->string('gangguan_irama_jantung', 5)->default('');

            $table->string('isk', 5)->default('');
            $table->string('hematuria', 5)->default('');
            $table->string('gejala_voiding2', 5)->default('');
            $table->string('retensi_urine2', 5)->default('');

            $table->string('pemeriksaan_penunjang', 5)->default('');

            $table->string('pemeriksaan_penunjang_usg', 5)->default('');
            $table->text('pemeriksaan_penunjang_usg_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_uroflowmetri', 5)->default('');
            $table->text('pemeriksaan_penunjang_uroflowmetri_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_pemeriksaan_laboratorium', 5)->default('');
            $table->text('pemeriksaan_penunjang_pemeriksaan_laboratorium_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_bladder_diary', 5)->default('');
            $table->text('pemeriksaan_penunjang_bladder_diary_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_upp', 5)->default('');
            $table->text('pemeriksaan_penunjang_upp_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_urodinamik', 5)->default('');
            $table->text('pemeriksaan_penunjang_urodinamik_ya')->default('a:0:{}');
            $table->string('pemeriksaan_penunjang_sistoskopi', 5)->default('');
            $table->text('pemeriksaan_penunjang_sistoskopi_ya')->default('a:0:{}');

            $table->string('follow_up_terapi', 5)->default('');
            $table->text('follow_up_terapi_ya')->default('a:0:{}');

            $table->string('terapi_modifikasi_gaya_hidup', 5)->default('');
            $table->text('terapi_modifikasi_gaya_hidup_ya')->default('a:0:{}');
            $table->string('terapi_non_operatif', 5)->default('');
            $table->text('terapi_non_operatif_ya')->default('a:0:{}');
            $table->string('terapi_medikamentosa', 5)->default('');
            $table->text('terapi_medikamentosa_ya')->default('a:0:{}');
            $table->string('terapi_rehabilitasi', 5)->default('');
            $table->text('terapi_rehabilitasi_ya')->default('a:0:{}');
            $table->string('terapi_operatif', 5)->default('');
            $table->text('terapi_operatif_ya')->default('a:0:{}');
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
        Schema::dropIfExists('oab_follow_up_detail');
    }
};
