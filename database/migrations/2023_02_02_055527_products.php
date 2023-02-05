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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('harga');
            $table->enum('kadar_air', ['rendah', 'sedang', 'tinggi']);
            $table->enum('tekstur', ['besar', 'sedang', 'kecil']);
            $table->enum('aroma', ['harum', 'tidak berbau', 'busuk']);
            $table->string('satuan');
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
        //
    }
};
