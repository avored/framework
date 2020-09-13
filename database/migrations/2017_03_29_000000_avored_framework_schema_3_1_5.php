<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AvoredFrameworkSchema315 extends Migration
{
    /**
     * @todo arrange Database Table Creation and foreign keys
     * Install the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->text('route_info')->nullable()->default(null);
            $table->enum('type', ['CATEGORY', 'FRONT_MENU', 'CUSTOM'])->nullable()->default(null);
        });
        
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('route_info');
            $table->dropColumn('type');
            $table->string('url')->nullable()->default(null); 
        });
    }
}
