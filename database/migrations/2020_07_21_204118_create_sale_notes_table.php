<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->decimal('monto_total',11,2);
            $table->unsignedBigInteger('sale_bill_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('sale_bill_id')->references('id')->on('sale_bills');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('sale_notes');
    }
}
