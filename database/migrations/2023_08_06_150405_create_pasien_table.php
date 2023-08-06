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
        Schema::create('m_pasien', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->string('code')->default('');
            $table->string('nik')->default('');
            $table->string('name')->default('');
            $table->date('lahir_date')->nullable();
            $table->text('address')->default('');
            $table->string('dokter_pemeriksa')->default('');
            $table->date('pemeriksaan_date')->nullable();
            $table->date('input_date')->nullable();
            $table->decimal('tb', 5, 2)->default(0.00);
            $table->decimal('bb', 5, 2)->default(0.00);
            $table->decimal('imt', 5, 2)->default(0.00);
            $table->integer('jenis_kelamin_id')->default(0);
            $table->integer('propinsi_id')->default(0);
            $table->integer('kabupaten_id')->default(0);
            $table->integer('rumah_sakit_id')->default(0);
            $table->integer('unit_pelayanan_id')->default(0);
            $table->integer('pendidikan_id')->default(0);
            $table->integer('pekerjaan_id')->default(0);
            $table->integer('status_pernikahan_id')->default(0);
            $table->integer('aktivitas_seksual_id')->default(0);
            $table->integer('suku_id')->default(0);
            $table->integer('datang_id')->default(0);
            $table->integer('jaminan_kesehatan_id')->default(0);
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
        Schema::dropIfExists('m_pasien');
    }
};
