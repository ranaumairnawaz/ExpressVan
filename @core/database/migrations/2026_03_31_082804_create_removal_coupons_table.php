<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('removal_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('discount_type'); // percentage, fixed, free_shipping
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->integer('total_limit')->nullable();
            $table->integer('limit_per_customer')->default(1);
            $table->decimal('min_amount', 10, 2)->nullable();
            $table->string('status')->default('publish'); // publish, draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('removal_coupons');
    }
};
