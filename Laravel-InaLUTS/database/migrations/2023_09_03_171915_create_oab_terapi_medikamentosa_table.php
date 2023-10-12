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
        Schema::create('oab_terapi_medikamentosa', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('pasien_id')->default(0);
            $table->string('medikamentosa', 5)->default('');
            $table->string('medikamentosa_ya', 20)->default('');
            $table->string('solifenacin', 5)->default('');
            $table->string('solifenacin_ya', 20)->default('');
            $table->string('imidafenacin', 5)->default('');
            $table->string('imidafenacin_ya', 20)->default('');
            $table->string('propiverine', 5)->default('');
            $table->string('propiverine_ya', 20)->default('');
            $table->string('tolterodine', 5)->default('');
            $table->string('tolterodine_ya', 20)->default('');
            $table->string('mirabegron', 5)->default('');
            $table->string('mirabegron_ya', 20)->default('');
            $table->string('flavoxate', 5)->default('');
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
        Schema::dropIfExists('oab_terapi_medikamentosa');
    }
};
