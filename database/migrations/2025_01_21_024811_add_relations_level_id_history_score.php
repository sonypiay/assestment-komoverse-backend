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
        Schema::table('tbl_history_score', function (Blueprint $table) {
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
        Schema::table('tbl_history_score', function (Blueprint $table) {
            $table->dropForeign('tbl_history_score_level_id_foreign');
            $table->dropIndex('tbl_history_score_level_id_foreign');
        });
    }
};
