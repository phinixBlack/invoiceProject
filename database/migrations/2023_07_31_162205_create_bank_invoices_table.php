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
        Schema::create('bank_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id');
            $table->string("payment_bank_ref_no");
            $table->double('paid_amount');
            $table->string('receipt_bank_ref_no');
            $table->double('receipt_amount');
            $table->double('bank_charge');
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
        Schema::dropIfExists('bank_invoices');
    }
};
