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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['seller','buyer']);
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('account_no')->nullable();
            $table->string('swift_no')->nullable();
            $table->string('IBAN_no')->nullable();
            $table->string('routing_no')->nullable();
            $table->string('port_loading')->nullable();
            $table->string('port_discharge')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('HS_code')->nullable();
            $table->string('incoterms')->nullable();
            $table->enum('status',['active','inactive']);
            $table->enum('soft_delete',['true','false'])->default('true');
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
        Schema::dropIfExists('customers');
    }
};
