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
        Schema::create('orders_burgers', function (Blueprint $table) {
            $table->foreignId('burger_id')->constrained('burgers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->unique()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('basket_id')->constrained('baskets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('count');
            $table->json('special_requests');
            $table->json('add_ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_burgers');
    }
};
