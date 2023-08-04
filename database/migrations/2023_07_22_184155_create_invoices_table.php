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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->bigInteger('item_id');
            $table->bigInteger('port_loading_id');
            $table->string('bl_no');
            $table->bigInteger('buyer_id');
            $table->string('net_weight');
            $table->string('rate');
            $table->string('packs');
            $table->string('gross_weight');
            $table->string('hs_code');
            $table->string('invoice_date')->nullable();
            $table->bigInteger('port_of_discharge');
            $table->bigInteger('seller_id');
            $table->date('bl_date');
            $table->string('bank_name');
            $table->string('incoterms');
            $table->string('trading_co');
            $table->string('buying_rate');
            $table->string('unit_measure');
            $table->string('mark');
            $table->enum('quality_certificate',['yes','no']);
            $table->string('contract_no');
            $table->string('quality_certi_context');
            $table->date('contract_no_date');
            $table->date('doc_credit_no_date');
            $table->string('doc_credit_no');
            $table->string('origin');
            $table->enum('freight_check',['true','false'])->default('false');
            $table->enum('bank_check',['true','false'])->default('false');
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
        Schema::dropIfExists('invoices');
    }
};
