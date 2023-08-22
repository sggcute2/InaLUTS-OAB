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
        Schema::create('oab_kuesioner_fsfi', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->tinyInteger('score_1')->nullable();
            $table->tinyInteger('score_2')->nullable();
            $table->tinyInteger('score_3')->nullable();
            $table->tinyInteger('score_4')->nullable();
            $table->tinyInteger('score_5')->nullable();
            $table->tinyInteger('score_6')->nullable();
            $table->tinyInteger('score_7')->nullable();
            $table->tinyInteger('score_8')->nullable();
            $table->tinyInteger('score_9')->nullable();
            $table->tinyInteger('score_10')->nullable();
            $table->tinyInteger('score_11')->nullable();
            $table->tinyInteger('score_12')->nullable();
            $table->tinyInteger('score_13')->nullable();
            $table->tinyInteger('score_14')->nullable();
            $table->tinyInteger('score_15')->nullable();
            $table->tinyInteger('score_16')->nullable();
            $table->tinyInteger('score_17')->nullable();
            $table->tinyInteger('score_18')->nullable();
            $table->tinyInteger('score_19')->nullable();
            $table->tinyInteger('total_score')->default(0);
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
        Schema::dropIfExists('oab_kuesioner_fsfi');
    }
};
