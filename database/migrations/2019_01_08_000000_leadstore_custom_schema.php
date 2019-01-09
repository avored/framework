<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadstoreCustomSchema extends Migration
{

    public function up()
    {
        Schema::table('orders', function($table) {
           $table->decimal('shipping_cost', 10, 2)->nullable();
        });
        /*
        Schema::create('order_lines', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->decimal('cost', 10, 2);
            $table->timestamps();
        });*/
    }

    public function down()
    {
//        Schema::dropIfExists('order_lines');
        Schema::table('orders', function($table) {
            $table->dropColumn(['shipping_cost']);
        });
    }

}
