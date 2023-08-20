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
            $table->date('bl_date');
            $table->bigInteger('buyer_id');
            $table->string('net_weight');
            $table->string('rate');
            $table->string('packs');
            $table->string('gross_weight');
            $table->string('hs_code');
            $table->date('invoice_date')->nullable();
            $table->bigInteger('port_of_discharge');
            $table->bigInteger('seller_id');
            $table->string('import_bl_no');
            $table->date('import_bl_date');
            $table->string('import_inv_no');
            $table->date('import_inv_date');
            $table->string('bank_name');
            $table->string('incoterms');
            $table->bigInteger('trading_co');
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
            $table->enum('status_payment',['unpaid','paid','partial-payment'])->default('unpaid');
            $table->string('vessel_name')->nullable();
            $table->double('freight')->nullable();
            $table->integer('amount_paid')->default(0);
            $table->double('amount_left')->default(0);
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
