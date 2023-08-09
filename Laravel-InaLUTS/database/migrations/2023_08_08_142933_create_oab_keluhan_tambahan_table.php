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
        Schema::create('oab_keluhan_tambahan', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('straining', 5)->default('');
            $table->string('intermittency', 5)->default('');
            $table->string('pancaran_lemah', 5)->default('');
            $table->string('tidak_lampias', 5)->default('');
            $table->string('hesitancy', 5)->default('');
            $table->string('hematuria', 5)->default('');
            $table->string('dysuria', 5)->default('');
            $table->string('terminal_dribbling', 5)->default('');
            $table->string('post_void_dribbling', 5)->default('');
            $table->string('urgensi', 5)->default('');
            $table->string('frekuensi', 5)->default('');
            $table->string('nokturia', 5)->default('');
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
        Schema::dropIfExists('oab_keluhan_tambahan');
    }
};
