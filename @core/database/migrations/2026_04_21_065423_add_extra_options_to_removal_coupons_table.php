<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('removal_coupons', function (Blueprint $table) {
            $table->text('excluded_services')->nullable()->comment('JSON array of excluded service keys');
            $table->boolean('stackable')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('removal_coupons', function (Blueprint $table) {
            $table->dropColumn(['excluded_services', 'stackable']);
        });
    }
};
