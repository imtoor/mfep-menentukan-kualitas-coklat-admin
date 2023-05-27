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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->nullable(true);
            
            $table->string('address', 100);
            $table->string('email', 50);
            $table->string('phone', 14);
            $table->string('note', 100)->nullable(true);

            $table->enum('payment_method', ['bank_transfer', 'cash']);
            $table->string('bank', 25)->nullable(true);
            $table->string('bank_holder', 50)->nullable(true);
            $table->string('bank_number', 25)->nullable(true);

            $table->string('delivery_name', 10);
            $table->integer('delivery_price');
            
            $table->tinyInteger('status')->default(0);
            $table->integer('total');
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
        Schema::dropIfExists('order');
    }
};
