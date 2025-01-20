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
            $table->uuid('user_id');
            $table->unsignedInteger('level')->default(0);
            $table->timestamps();

            $table->primary(['user_id', 'level']);
            $table->foreign('user_id')
            ->on('tbl_users')
            ->references('id')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
