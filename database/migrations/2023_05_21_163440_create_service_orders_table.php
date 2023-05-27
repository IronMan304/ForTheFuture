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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('service_order_date')->nullable();//should not be nullable
            $table->string('service_order_status');
            $table->string('total_services');
            $table->string('service_sub_total')->nullable();
            $table->string('service_vat')->nullable();;
            $table->string('service_invoice_no')->nullable();;
            $table->string('total')->nullable();;
            $table->string('service_payment_status')->nullable();;
            $table->string('service_pay')->nullable();;
            $table->string('service_due')->nullable();;
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
        Schema::dropIfExists('service_orders');
    }
};
