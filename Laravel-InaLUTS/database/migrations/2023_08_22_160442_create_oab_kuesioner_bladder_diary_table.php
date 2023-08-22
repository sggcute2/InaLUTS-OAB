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
        Schema::create('oab_kuesioner_bladder_diary', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('intake_cairan_1', 10)->default('');
            $table->string('intake_cairan_2', 10)->default('');
            $table->string('frekuensi_kencing_1', 10)->default('');
            $table->string('frekuensi_kencing_2', 10)->default('');
            $table->string('nocturia_1', 10)->default('');
            $table->string('nocturia_2', 10)->default('');
            $table->string('porsi_miksi_1', 10)->default('');
            $table->string('porsi_miksi_2', 10)->default('');
            $table->string('produksi_urin_1', 10)->default('');
            $table->string('produksi_urin_2', 10)->default('');
            $table->string('urgency_1', 10)->default('');
            $table->string('urgency_2', 10)->default('');
            $table->string('inkontinensia_urine_1', 10)->default('');
            $table->string('inkontinensia_urine_2', 10)->default('');
            $table->string('poliuria_nocturnal', 5)->default('');
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
        Schema::dropIfExists('oab_kuesioner_bladder_diary');
    }
};
