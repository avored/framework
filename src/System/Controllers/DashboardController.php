<?php
namespace AvoRed\Framework\System\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DashboardController
{
    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });

        Schema::create('attribute_product_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_dropdown_option_id');

            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
            $table->timestamps();
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('variation_id')->references('id')->on('products');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });

        return view('avored::admin');
    }
}
