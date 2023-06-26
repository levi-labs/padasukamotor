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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('barang_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('qty',30);
            $table->string('harga',30);
            $table->string('subtotal',32);
            $table->date('tanggal');
            $table->string('status',30)->default('unpaid');

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
