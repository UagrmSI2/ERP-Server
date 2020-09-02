<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_note_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('deposit_id');
            $table->integer('cantidad');
            $table->decimal('precio',11,2);
            $table->foreign('purchase_note_id')->references('id')->on('purchase_notes');
            $table->foreign('product_id')->references('product_id')->on('deposit_products');
            $table->foreign('deposit_id')->references('deposit_id')->on('deposit_products');
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
        Schema::dropIfExists('purchase_details');
    }
}
