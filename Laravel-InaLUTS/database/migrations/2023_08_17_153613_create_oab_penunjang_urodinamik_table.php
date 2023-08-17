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
        Schema::create('oab_penunjang_urodinamik', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('pemeriksaan_urodinamik', 5)->default('');
            $table->date('pemeriksaan_urodinamik_ya_date')->nullable();
            $table->string('kapasitas_kandung_kemih_1', 10)->default('');
            $table->string('kapasitas_kandung_kemih_2', 10)->default('');
            $table->string('compliance', 20)->default('');
            $table->string('detrusor_overactivity', 5)->default('');
            $table->string('detrusor_overactivity_incontinence', 5)->default('');
            $table->string('urodynamic_stress_urinary_incontinence', 5)->default('');
            $table->string('obstruksi_infravesical', 5)->default('');
            $table->string('detrusor_underactivity', 5)->default('');
            $table->string('disfunctional_voiding', 20)->default('');
            $table->string('pvr_1', 10)->default('');
            $table->string('pvr_2', 10)->default('');
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
        Schema::dropIfExists('oab_penunjang_urodinamik');
    }
};
