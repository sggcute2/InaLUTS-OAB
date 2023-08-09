<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Registry\Models\Registry;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_registry', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->string('name')->default('');
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

        Registry::insert(['name' => 'Overactive Bladder']);
        Registry::insert(['name' => 'Benign Prostatic Hyperplasia']);
        Registry::insert(['name' => 'Mixed Urinary Incontinence']);
        Registry::insert(['name' => 'Detrusor Underactivity']);
        Registry::insert(['name' => 'Stress Urinary Incontinence']);
        Registry::insert(['name' => 'Bladder Pain Syndrome']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_registry');
    }
};
