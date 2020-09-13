<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use AvoRed\Framework\Database\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Arr;

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
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('is_super_admin')->nullable()->default(null);
            $table->bigInteger('role_id')->unsigned()->default(null);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('language')->nullable()->default('en');
            $table->string('image_path')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image_path')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable()->default(null);
            $table->text('value')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->string('phone_code')->nullable()->default(null);
            $table->string('currency_code')->nullable()->default(null);
            $table->string('currency_symbol')->nullable()->default(null);
            $table->string('lang_code')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->string('symbol')->nullable()->default(null);
            $table->decimal('conversation_rate', 10, 6)->nullable()->default(null);
            $table->enum('status', ['ENABLED', 'DISABLED'])->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('data_type', ['INTEGER', 'DECIMAL', 'DATETIME', 'VARCHAR', 'BOOLEAN', 'TEXT'])
                ->nullable()
                ->default(null);
            $table->enum(
                'field_type',
                ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME', 'RADIO', 'SWITCH']
            );
            $table->tinyInteger('use_for_all_products')->default(0);
            $table->tinyInteger('use_for_category_filter')->default(0);
            $table->tinyInteger('is_visible_frontend')->nullable()->default(1);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::create('property_dropdown_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('display_as', ['IMAGE', 'TEXT'])->default('TEXT');
            $table->timestamps();
        });
        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id');
            $table->string('display_text');
            $table->string('path')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('customer_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('tax_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('tax_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->float('rate', 10, 6);
            $table->unsignedBigInteger('country_id');
            $table->integer('postcode')->nullable()->default(null);
            $table->enum('rate_type', ['PERCENTAGE', 'FIXED'])->default('PERCENTAGE');
            $table->timestamps();
        });

        Schema::create('menu_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('identifier')->nullable()->default(null);
            $table->tinyInteger('is_default')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_group_id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('cascade');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['BASIC', 'VARIATION', 'DOWNLOADABLE', 'VARIABLE_PRODUCT'])->default('BASIC');
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->string('barcode')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->decimal('qty', 10, 6)->nullable();
            $table->tinyInteger('is_taxable')->nullable()->default(null);
            $table->decimal('price', 10, 6)->nullable()->default(null);
            $table->decimal('cost_price', 10, 6)->nullable()->default(null);
            $table->float('weight')->nullable()->default(null);
            $table->float('width')->nullable()->default(null);
            $table->float('height')->nullable()->default(null);
            $table->float('length')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->text('path')->nullable()->default(null);
            $table->string('alt_text')->nullable()->default(null);
            $table->boolean('is_main_image')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_varchar_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->string('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_datetime_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamp('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_integer_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_decimal_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_text_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->text('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_boolean_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('value')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('type', ['SHIPPING', 'BILLING']);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('company_name')->nullable()->default(null);
            $table->string('address1')->nullable()->default(null);
            $table->string('address2')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shipping_option');
            $table->string('payment_option');
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('currency_id')->nullable()->default(null);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->unsignedBigInteger('billing_address_id')->nullable();
            $table->string('track_code')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->decimal('qty', 11, 6);
            $table->decimal('price', 11, 6);
            $table->decimal('tax_amount', 11, 6);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('order_product_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_dropdown_option_id');
            $table->timestamps();

            $table->foreign('order_product_id')->references('id')->on('order_products');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
        });

        Schema::create('category_filters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('filter_id');
            $table->enum('type', ['ATTRIBUTE', 'PROPERTY']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

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
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('attribute_dropdown_option_id');

            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('variation_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
            $table->timestamps();
        });

        Schema::create('promotion_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->boolean('status')->nullable()->default(false);
            $table->enum('type', ['PERCENTAGE', 'FIXED', 'FREE_SHIPPING'])->nullable()->default(null);
            $table->decimal('amount', 10, 4)->nullable()->default(null);
            $table->timestamp('active_from')->nullable()->default(null);
            $table->timestamp('active_till')->nullable()->default(null);
            $table->timestamps();
        });

        $path = __DIR__.'/../../assets/countries.json';
        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $country) {
            Country::create([
                'code' => strtolower(Arr::get($country, 'alpha2Code')),
                'name' => Arr::get($country, 'name'),
                'phone_code' => Arr::get($country, 'callingCodes.0'),
                'currency_code' => Arr::get($country, 'currencies.0.code'),
                'currency_symbol' => Arr::get($country, 'currencies.0.symbol'),
                'lang_code' => Arr::get($country, 'languages.0.name'),
            ]);
        }
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('promotion_codes');
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('attribute_product_values');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('category_filters');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');

        Schema::dropIfExists('product_property_boolean_values');
        Schema::dropIfExists('product_property_text_values');
        Schema::dropIfExists('product_property_decimal_values');
        Schema::dropIfExists('product_property_integer_values');
        Schema::dropIfExists('product_property_datetime_values');
        Schema::dropIfExists('product_property_varchar_values');

        Schema::dropIfExists('product_property');

        Schema::dropIfExists('tax_rates');
        Schema::dropIfExists('tax_groups');
        Schema::dropIfExists('customer_groups');

        Schema::dropIfExists('property_dropdown_options');
        Schema::dropIfExists('properties');

        Schema::dropIfExists('attribute_dropdown_options');
        Schema::dropIfExists('attributes');

        Schema::dropIfExists('currencies');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('configurations');
        Schema::dropIfExists('order_statuses');

        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');

        Schema::dropIfExists('categories');

        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_password_resets');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('languages');

        Schema::enableForeignKeyConstraints();
    }
}
