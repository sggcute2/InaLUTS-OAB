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
        Schema::create('oab_riwayat_operasi_urologi', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('tur_prostat', 5)->default('');
            $table->date('tur_prostat_ya_date')->nullable();
            $table->string('radikal_prostat', 5)->default('');
            $table->date('radikal_prostat_ya_date')->nullable();
            $table->string('rekonstruksi_uretra', 5)->default('');
            $table->date('rekonstruksi_uretra_ya_date')->nullable();
            $table->string('tur_buli', 5)->default('');
            $table->date('tur_buli_ya_date')->nullable();
            $table->string('operasi_anti_inkontinensia_urine', 5)->default('');
            $table->tinyInteger('c_operasi_anti_inkontinensia_urine_sling')->default(0);
            $table->tinyInteger('c_operasi_anti_inkontinensia_urine_burch_kolposuspensi')->default(0);
            $table->tinyInteger('c_operasi_anti_inkontinensia_urine_aus')->default(0);
            $table->tinyInteger('c_operasi_anti_inkontinensia_urine_bulking_agent')->default(0);
            $table->string('operasi_pop', 5)->default('');
            $table->date('operasi_pop_ya_date')->nullable();
            $table->string('injeksi_botox', 5)->default('');
            $table->date('injeksi_botox_ya_date')->nullable();
            $table->string('sistoskopi', 5)->default('');
            $table->date('sistoskopi_ya_date')->nullable();
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
        Schema::dropIfExists('oab_riwayat_operasi_urologi');
    }
};
