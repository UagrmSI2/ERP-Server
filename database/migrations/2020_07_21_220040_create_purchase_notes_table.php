<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->decimal('monto_total',11,2);
            $table->unsignedBigInteger('provider_id');
           // $table->unsignedBigInteger('purchase_bill_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            //$table->foreign('purchase_bill_id')->references('id')->on('purchase_bills');
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
        Schema::dropIfExists('purchase_notes');
    }
}
