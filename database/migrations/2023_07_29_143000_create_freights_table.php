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
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id');
            $table->string("agent");
            $table->double('freight_amount_usd');
            $table->string('freight_invoice_no');
            $table->double('miscellaneous_expense');
            $table->string('miscellaneous_invoice_no');
            $table->double('insurance_amount');
            $table->enum('bill_paid', ['yes', 'no'])->default('yes');
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
        Schema::dropIfExists('freights');
    }
};
