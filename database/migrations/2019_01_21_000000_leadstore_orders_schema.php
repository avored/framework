<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadstoreOrdersSchema extends Migration
{

    public function up()
    {
        Schema::table('orders', function ($table) {
            $table->json('shipping_data')->nullable();
            $table->json('billing_data')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function ($table) {
            $table->dropColumn(['shipping_data', 'billing_data']);
        });

    }

}
