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
        Schema::create('oab_riwayat_operasi_non_urologi', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('operasi_tulang_belakang', 5)->default('');
            $table->string('operasi_area_pelvik', 5)->default('');
            $table->string('operasi_di_daerah_pelvis', 5)->default('');
            $table->tinyInteger('c_operasi_di_daerah_pelvis_histrektomi')->default(0);
            $table->tinyInteger('c_operasi_di_daerah_pelvis_miomektomi')->default(0);
            $table->tinyInteger('c_operasi_di_daerah_pelvis_kistektomi')->default(0);
            $table->tinyInteger('c_operasi_di_daerah_pelvis_salfingo_ovorektomi')->default(0);
            $table->tinyInteger('c_operasi_di_daerah_pelvis_operasi_ca_colorektal')->default(0);
            $table->string('operasi_kraniotomi', 5)->default('');
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
        Schema::dropIfExists('oab_riwayat_operasi_non_urologi');
    }
};
