<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Pendidikan\Models\Pendidikan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_pendidikan', function (Blueprint $table) {
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

        pendidikan::insert(['name' => 'Tidak Tamat']);
        pendidikan::insert(['name' => 'SD']);
        pendidikan::insert(['name' => 'SMP']);
        pendidikan::insert(['name' => 'SMA']);
        pendidikan::insert(['name' => 'S1']);
        pendidikan::insert(['name' => 'S2']);
        pendidikan::insert(['name' => 'S3']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pendidikan');
    }
};
