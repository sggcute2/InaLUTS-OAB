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
        Schema::create('oab_pemeriksaan_imaging', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('usg', 20)->default('');
            $table->date('usg_date')->nullable();
            $table->string('ct_urografi', 10)->default('');
            $table->string('ginjal__kanan__hidronefrosis', 10)->default('');
            $table->string('ginjal__kanan__batu', 10)->default('');
            $table->string('ginjal__kiri__hidronefrosis', 10)->default('');
            $table->string('ginjal__kiri__batu', 10)->default('');
            $table->string('buli__batu', 10)->default('');
            $table->string('buli__divertikel', 10)->default('');
            $table->string('buli__massa_intrabuli', 10)->default('');
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
        Schema::dropIfExists('oab_pemeriksaan_imaging');
    }
};
