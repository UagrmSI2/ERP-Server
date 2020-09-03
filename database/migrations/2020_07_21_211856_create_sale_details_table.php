<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_note_id');
            /* $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('deposit_id'); */
            $table->unsignedBigInteger('deposit_product_id');
            $table->integer('cantidad');
            $table->decimal('precio',11,2);
            $table->foreign('sale_note_id')->references('id')->on('sale_notes');
            $table->foreign('deposit_product_id')->references('id')->on('deposit_products');
            /* $table->foreign('product_id')->references('product_id')->on('deposit_products');
            $table->foreign('deposit_id')->references('deposit_id')->on('deposit_products'); */
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
        Schema::dropIfExists('sale_details');
    }
}
