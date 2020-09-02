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
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('client_id')->references('id')->on('clients');
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
