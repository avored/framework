<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Models\Database\OrderStatus;

class AvoredFrameworkSchema extends Migration
{
    /**
     * @todo arrange Database Table Creation and foreign keys
     * Install the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['BASIC', 'VARIATION', 'DOWNLOADABLE', 'VARIABLE_PRODUCT'])->default('BASIC');

            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->decimal('qty', 10, 6)->nullable();
            $table->tinyInteger('is_taxable')->nullable()->default(null);

            $table->float('weight')->nullable()->default(null);
            $table->float('width')->nullable()->default(null);
            $table->float('height')->nullable()->default(null);
            $table->float('length')->nullable()->default(null);

            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->decimal('price', 10, 6);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->text('path');
            $table->boolean('is_main_image')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_default')->default(false);
            $table->timestamps();
        });

        OrderStatus::insert([
            ['name' => 'Pending', 'is_default' => 1],
            ['name' => 'Delivered', 'is_default' => 0],
            ['name' => 'Received', 'is_default' => 0],
            ['name' => 'Canceled', 'is_default' => 0],
        ]);

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('shipping_option');
            $table->string('payment_option');
            $table->integer('order_status_id')->unsigned();
            $table->timestamps();

            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');
            $table->decimal('price', 11, 6);
            $table->decimal('tax_amount', 11, 6);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->enum('data_type', ['INTEGER', 'DECIMAL', 'DATETIME', 'VARCHAR', 'BOOLEAN', 'TEXT'])->nullable()->default(null);
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME', 'CHECKBOX', 'RADIO', 'SWITCH']);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('property_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
        });

        Schema::create('product_property_varchar_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_datetime_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamp('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_integer_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_decimal_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_text_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->text('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_boolean_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->tinyInteger('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->timestamps();
        });

        Schema::create('attribute_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('product_attribute_integer_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variation_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('variation_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_product_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_dropdown_option_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
        });
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_variations');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_attribute_integer_values');

        Schema::dropIfExists('attribute_dropdown_options');
        Schema::dropIfExists('attribute_product');

        Schema::dropIfExists('product_property_boolean_values');
        Schema::dropIfExists('product_property_text_values');
        Schema::dropIfExists('product_property_decimal_values');
        Schema::dropIfExists('product_property_integer_values');
        Schema::dropIfExists('product_property_varchar_values');
        Schema::dropIfExists('product_property_datetime_values');
        Schema::dropIfExists('property_dropdown_options');
        Schema::dropIfExists('properties');

        Schema::dropIfExists('category_product');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');

        Schema::dropIfExists('attributes');

        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('product_order');
        Schema::dropIfExists('orders');
    }
}
