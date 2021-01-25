<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('sub_total');
            $table->float('tax_rate');
            $table->float('tax_ammount');
            $table->float('total');
            $table->float('ammount_paid');
            $table->float('ammount_due');
            $table->string('notes');
            $table->string('cust_name');
            $table->string('cust_address');
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
        Schema::dropIfExists('orders');
    }
}
