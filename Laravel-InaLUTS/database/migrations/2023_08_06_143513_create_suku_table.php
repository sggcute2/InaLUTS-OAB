<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Suku\Models\Suku;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_suku', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->string('name')->default('');
            $table->integer('pos')->default(0);
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

        Suku::insert(['name' => 'Jawa', 'pos' => 1]);
        Suku::insert(['name' => 'Sunda', 'pos' => 2]);
        Suku::insert(['name' => 'Batak', 'pos' => 3]);
        Suku::insert(['name' => 'Bugis', 'pos' => 4]);
        Suku::insert(['name' => 'Betawi', 'pos' => 5]);
        Suku::insert(['name' => 'Dayak', 'pos' => 6]);
        Suku::insert(['name' => 'Sasak', 'pos' => 7]);
        Suku::insert(['name' => 'Tionghoa', 'pos' => 8]);
        Suku::insert(['name' => 'Lainnya', 'pos' => 100]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_suku');
    }
};
