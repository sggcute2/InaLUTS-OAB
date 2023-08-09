<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Jaminan_kesehatan\Models\Jaminan_kesehatan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_jaminan_kesehatan', function (Blueprint $table) {
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

        Jaminan_kesehatan::insert(['name' => 'Pribadi', 'pos' => 1]);
        Jaminan_kesehatan::insert(['name' => 'JKN', 'pos' => 2]);
        Jaminan_kesehatan::insert(['name' => 'Swasta', 'pos' => 3]);
        Jaminan_kesehatan::insert(['name' => 'Lainnya', 'pos' => 100]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_jaminan_kesehatan');
    }
};
