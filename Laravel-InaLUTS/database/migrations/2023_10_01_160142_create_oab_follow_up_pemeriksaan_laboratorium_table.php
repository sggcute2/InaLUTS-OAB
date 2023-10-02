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
        Schema::create('oab_follow_up_pemeriksaan_laboratorium', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->integer('follow_up_id')->default(0);

            $table->date('lab_date')->nullable();
            $table->string('hb', 10)->default('');
            $table->string('leukosit', 10)->default('');
            $table->string('trombosit', 10)->default('');
            $table->string('ureum', 10)->default('');
            $table->string('kreatinin', 10)->default('');
            $table->string('gds', 10)->default('');
            $table->string('ph', 10)->default('');
            $table->string('protein', 10)->default('');
            $table->string('glukosa', 10)->default('');
            $table->string('nitrit', 10)->default('');
            $table->string('leukosit_esterase', 10)->default('');
            $table->string('eritrosit', 10)->default('');
            $table->string('urinalisa_leukosit', 10)->default('');
            $table->string('kristal', 10)->default('');
            $table->string('bakteri', 10)->default('');
            $table->string('jamur', 10)->default('');
            $table->string('kultur_urin', 100)->default('');
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
        Schema::dropIfExists('oab_follow_up_pemeriksaan_laboratorium');
    }
};
