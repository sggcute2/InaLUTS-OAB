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
        Schema::create('oab_penunjang', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('pvr', 10)->default('');
            $table->string('cara_mengukur_pvr', 20)->default('');
            $table->string('upp', 20)->default('');
            $table->string('maximal_urethral_pressure', 10)->default('');
            $table->string('functional_urethral_length', 10)->default('');
            $table->string('sistoskopi', 20)->default('');
            $table->string('mukosa_buli', 20)->default('');
            $table->string('trabekulasi', 20)->default('');
            $table->string('sakulasi_divertikel', 20)->default('');
            $table->string('kapasitas_buli', 10)->default('');
            $table->string('batu', 20)->default('');
            $table->string('tumor', 20)->default('');
            $table->string('lobus_medius', 20)->default('');
            $table->string('kissing_lobe', 10)->default('');
            $table->string('kissing_lobe_ya', 10)->default('');
            $table->string('muara_ureter', 20)->default('');
            $table->string('urethra', 20)->default('');
            $table->string('mue', 20)->default('');
            $table->string('lichen_schlerosis', 20)->default('');
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
        Schema::dropIfExists('oab_penunjang');
    }
};
