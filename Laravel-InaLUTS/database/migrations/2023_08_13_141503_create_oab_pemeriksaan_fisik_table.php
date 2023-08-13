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
        Schema::create('oab_pemeriksaan_fisik', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('gangguan_neurologi', 5)->default('');
            $table->tinyInteger('c_gangguan_neurologi_tremor')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_fascial_palsy')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_hemiparesis')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_paraparesis')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_tetraparesis')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_hemiplegi')->default(0);
            $table->tinyInteger('c_gangguan_neurologi_paraplegi')->default(0);
            $table->string('cor', 20)->default('');
            $table->string('pulmo', 20)->default('');
            $table->string('bulbocavernosus_refleks', 20)->default('');
            $table->string('atrofi_vagina', 20)->default('');
            $table->string('pop', 5)->default('');
            $table->string('pop_ya')->default('');
            $table->string('massa_di_daerah_pelvis', 5)->default('');
            $table->string('uretra', 20)->default('');
            $table->tinyInteger('c_uretra_caruncle')->default(0);
            $table->tinyInteger('c_uretra_stenosis')->default(0);
            $table->string('tonus_spingter_ani', 20)->default('');
            $table->string('tonus_levator_ani', 20)->default('');
            $table->string('pelvic_floor', 5)->default('');
            $table->string('prostat', 20)->default('');
            $table->string('prostat_tidak')->default('');
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
        Schema::dropIfExists('oab_pemeriksaan_fisik');
    }
};
