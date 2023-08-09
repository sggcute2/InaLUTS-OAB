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
        Schema::create('oab_faktor_resiko', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('alergi', 5)->default('');
            $table->string('penyakit_paru', 5)->default('');
            $table->string('gangguan_mood', 5)->default('');
            $table->string('gangguan_mood_ya', 50)->default('');
            $table->string('gangguan_mood_ya2', 50)->default('');
            $table->string('diabetes', 20)->default('');
            $table->string('diabetes_ya', 50)->default('');
            $table->string('penyakit_jantung_kongestif', 5)->default('');
            $table->string('penyakit_saluran_cerna', 5)->default('');
            $table->string('hipertensi', 20)->default('');
            $table->string('menopause', 5)->default('');
            $table->string('menopause_ya', 50)->default('');
            $table->string('overdistensi_buli', 5)->default('');
            $table->string('kanker_ginekologi', 5)->default('');
            $table->string('kanker_ginekologi_ya', 50)->default('');
            $table->string('stroke', 5)->default('');
            $table->string('spinal_cord_injury', 5)->default('');
            $table->string('trauma_tulang_belakang', 5)->default('');
            $table->string('tumor_tulang_belakang', 5)->default('');
            $table->string('myelitis', 5)->default('');
            $table->string('spondilitis_tb', 5)->default('');
            $table->string('parkinson', 5)->default('');
            $table->string('penyakit_saraf_tepi', 5)->default('');
            $table->string('hnp', 5)->default('');
            $table->string('multiple_sclerosis', 5)->default('');
            $table->string('msa', 5)->default('');
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
        Schema::dropIfExists('oab_faktor_resiko');
    }
};
