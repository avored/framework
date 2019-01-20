<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadstoreAddressSchema extends Migration
{

    public function up()
    {
        Schema::table('addresses', function ($table) {
            $table->string('address_number')->nullable();
            $table->string('address_complement')->nullable();
        });
    }

    public function down()
    {
        Schema::table('addresses', function ($table) {
            $table->dropColumn(['address_number', 'address_complement']);
        });

    }

}
