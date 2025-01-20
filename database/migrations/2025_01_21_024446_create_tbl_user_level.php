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
        Schema::create('tbl_user_level', function (Blueprint $table) {
            $table->char('user_id', 36);
            $table->char('level_id', 36)->nullable();
            $table->dateTime('last_updated');
            $table->primary('user_id');

            $table->foreign('user_id')
            ->references('id')
            ->on('tbl_users')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('level_id')
            ->references('id')
            ->on('tbl_levels')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_level');
    }
};
