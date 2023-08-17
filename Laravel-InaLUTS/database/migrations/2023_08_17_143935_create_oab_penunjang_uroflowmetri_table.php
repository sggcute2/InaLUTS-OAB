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
        Schema::create('oab_penunjang_uroflowmetri', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('voided_volume', 5)->default('');
            $table->date('voided_volume_ya_date')->nullable();
            $table->string('voided_volume_ya', 10)->default('');
            $table->string('q_max', 5)->default('');
            $table->date('q_max_ya_date')->nullable();
            $table->string('q_max_ya', 10)->default('');
            $table->string('q_ave', 5)->default('');
            $table->date('q_ave_ya_date')->nullable();
            $table->string('q_ave_ya', 10)->default('');
            $table->string('pvr', 5)->default('');
            $table->date('pvr_ya_date')->nullable();
            $table->string('pvr_ya', 10)->default('');
            $table->string('voiding_time', 5)->default('');
            $table->date('voiding_time_ya_date')->nullable();
            $table->string('voiding_time_ya', 10)->default('');
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
        Schema::dropIfExists('oab_penunjang_uroflowmetri');
    }
};
