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
        Schema::create('oab_terapi_modifikasi_gaya_hidup', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->date('terapi_date')->nullable();
            $table->string('menurunkan_berat_badan', 5)->default('');
            $table->string('penilaian_jenis', 5)->default('');
            $table->string('bladder_training', 5)->default('');
            $table->tinyInteger('c_bladder_training_timed_voiding')->default(0);
            $table->tinyInteger('c_bladder_training_timed_voiding_berkemih_spontan')->default(0);
            $table->tinyInteger('c_bladder_training_timed_voiding_katerisasi')->default(0);
            $table->tinyInteger('c_bladder_training_prompt_voiding')->default(0);
            $table->tinyInteger('c_bladder_training_urge_suppression_strategies')->default(0);
            $table->string('stop_merokok', 5)->default('');
            $table->string('manajemen_stress', 5)->default('');
            $table->string('manajemen_komorbid', 5)->default('');
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
        Schema::dropIfExists('oab_terapi_modifikasi_gaya_hidup');
    }
};
