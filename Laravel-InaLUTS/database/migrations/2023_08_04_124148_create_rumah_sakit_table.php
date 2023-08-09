<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_rumah_sakit', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->integer('kota_id')->default(0);
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

        Rumah_sakit::insert(['name' => 'RSUPN Cipto Mangunkusumo', 'kota_id' => 1]);
        Rumah_sakit::insert(['name' => 'RSUP Persahabatan', 'kota_id' => 1]);
        Rumah_sakit::insert(['name' => 'RSUP Fatmawati', 'kota_id' => 1]);
        Rumah_sakit::insert(['name' => 'RSUD Dr. Soetomo', 'kota_id' => 2]);
        Rumah_sakit::insert(['name' => 'RSUD Dr. Saiful Anwar', 'kota_id' => 3]);
        Rumah_sakit::insert(['name' => 'RSUP Sanglah', 'kota_id' => 4]);
        Rumah_sakit::insert(['name' => 'RSUP Dr. Hasan Sadikin', 'kota_id' => 5]);
        Rumah_sakit::insert(['name' => 'RSUP Dr. Sardjito', 'kota_id' => 6]);
        Rumah_sakit::insert(['name' => 'RSUP Dr. Kariadi', 'kota_id' => 7]);
        Rumah_sakit::insert(['name' => 'RSUD Abdul Wahab Sjahranie', 'kota_id' => 8]);
        Rumah_sakit::insert(['name' => 'RS UNHAS', 'kota_id' => 9]);
        Rumah_sakit::insert(['name' => 'RSUP Dr. Wahidin Sudirohusodo', 'kota_id' => 9]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_rumah_sakit');
    }
};
