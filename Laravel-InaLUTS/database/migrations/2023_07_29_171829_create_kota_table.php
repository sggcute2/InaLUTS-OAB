<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Kota\Models\Kota;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_kota', function (Blueprint $table) {
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

        Kota::insert(['name' => 'Jakarta']);
        Kota::insert(['name' => 'Surabaya']);
        Kota::insert(['name' => 'Malang']);
        Kota::insert(['name' => 'Bali']);
        Kota::insert(['name' => 'Bandung']);
        Kota::insert(['name' => 'Yogyakarta']);
        Kota::insert(['name' => 'Semarang']);
        Kota::insert(['name' => 'Samarinda']);
        Kota::insert(['name' => 'Makassar']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kota');
    }
};
