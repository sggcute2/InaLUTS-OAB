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
        Schema::create('oab_follow_up_media', function (Blueprint $table) {
            $table->id();

            //===[ FIELDS ]=====================================================
            $table->string('table_reference')->default('');
			$table->unsignedBigInteger('reference_id')->default(0);
            $table->string('custom_field_1')->default('');
            $table->string('original_name')->default('');
            $table->string('file')->default('');
            $table->string('ext')->default('');
			$table->unsignedBigInteger('size')->default(0);
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
        Schema::dropIfExists('oab_follow_up_media');
    }
};
