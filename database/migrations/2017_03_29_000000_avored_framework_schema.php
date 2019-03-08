<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Models\Database\SiteCurrency;
use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Database\MenuGroup;
use AvoRed\Framework\Models\Database\Menu;

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
        Schema::create('languages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('category_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable()->default(null);
            $table->unsignedInteger('language_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

        Schema::create('category_filters', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable()->default(null);
            $table->enum('type', ['ATTRIBUTE', 'PROPERTY'])->nullable()->default(null);
            $table->integer('filter_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('products', function(Blueprint $table) {
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

        Schema::create('category_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('product_downloadable_urls', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('demo_path')->nullable()->default(null);
            $table->string('main_path')->nullable()->default(null);
            $table->string('token');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->text('path');
            $table->boolean('is_main_image')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_statuses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        OrderStatus::insert([
            ['name' => 'New', 'is_default' => 1],
            ['name' => 'Pending Payment', 'is_default' => 0],
            ['name' => 'Processing', 'is_default' => 0],
            ['name' => 'Shipped', 'is_default' => 0],
            ['name' => 'Delivered', 'is_default' => 0],
            ['name' => 'Canceled', 'is_default' => 0],
        ]);

        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');

            $table->string('shipping_option');
            $table->string('payment_option');
            $table->integer('order_status_id')->unsigned();
            $table->string('currency_code')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });

        Schema::create('order_histories', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned()->nullable()->default(null);
            $table->integer('order_status_id')->unsigned()->nullable()->default(null);

            $table->timestamps();

            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('order_id')->references('id')->on('orders');
        });

        Schema::create('order_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');
            $table->decimal('price', 11, 6);
            $table->decimal('tax_amount', 11, 6);
            $table->json('product_info')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_return_requests', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned()->nullable()->default(null);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->enum('status', ['PENDING', 'IN_PROGRESSS', 'APPROVED', 'REJECTED'])->nullable()->default(null);
            $table->text('comment')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('order_return_products', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('order_return_request_id')->unsigned()->nullable()->default(null);
            $table->foreign('order_return_request_id')->references('id')->on('order_return_requests')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->nullable()->default(null);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('qty');
            $table->text('reason')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('properties', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->enum('data_type', ['INTEGER', 'DECIMAL', 'DATETIME', 'VARCHAR', 'BOOLEAN', 'TEXT'])->nullable()->default(null);
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME', 'CHECKBOX', 'RADIO', 'SWITCH']);
            $table->tinyInteger('use_for_all_products')->default(0);
            $table->tinyInteger('is_visible_frontend')->nullable()->default(1);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('property_dropdown_options', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
        });

        Schema::create('product_property', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_property_varchar_values', function(Blueprint $table) {
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

        Schema::create('product_property_datetime_values', function(Blueprint $table) {
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

        Schema::create('product_property_integer_values', function(Blueprint $table) {
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

        Schema::create('product_property_decimal_values', function(Blueprint $table) {
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

        Schema::create('product_property_text_values', function(Blueprint $table) {
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

        Schema::create('product_property_boolean_values', function(Blueprint $table) {
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

        Schema::create('attributes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->timestamps();
        });

        Schema::create('attribute_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('attribute_dropdown_options', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('product_attribute_integer_values', function(Blueprint $table) {
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

        Schema::create('product_variations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('variation_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('variation_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_product_variations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_dropdown_option_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            ;
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
        });

        Schema::create('configurations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('configuration_key')->nullable()->default(null);
            $table->string('configuration_value', 999)->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('admin_password_resets', function(Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('password_resets', function(Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('admin_users', function(Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_super_admin')->nullable()->default(null);
            $table->integer('role_id')->unsigned()->default(null);
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

        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['GUEST', 'LIVE', 'DELETE_IN_PROGRESS'])->default('LIVE');
            $table->string('tax_no')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('delete_due_date')->nullable()->default(null);
            $table->enum('registered_channel', ['WEBSITE', 'FACEBOOK', 'TWITTER', 'GOOGLE'])->default('WEBSITE');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
                
        });

        Schema::create('user_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('user_user_group', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('user_group_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_group_id')->references('id')->on('user_groups')->onDelete('cascade');
        });

        Schema::create('countries', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('phone_code')->nullable()->default(null);
            $table->string('currency_code')->nullable()->default(null);
            $table->string('currency_symbol')->nullable()->default(null);
            $table->string('lang_code')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('site_currencies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('symbol');
            $table->string('name');
            $table->float('conversion_rate');
            $table->enum('status', ['ENABLED', 'DISABLED'])->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['SHIPPING', 'BILLING']);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('address1')->nullable()->default(null);
            $table->string('address2')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->integer('country_id')->unsigned()->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('oauth_auth_codes', function(Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_access_tokens', function(Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id')->index()->nullable();
            $table->integer('client_id');
            $table->string('name')->nullable();
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_refresh_tokens', function(Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_clients', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->nullable();
            $table->string('name');
            $table->string('secret', 100);
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
        });

        Schema::create('oauth_personal_access_clients', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index();
            $table->timestamps();
        });

        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('wishlists', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permission_role', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('states', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('shipping_address_id')->unsigned()->nullable();
            $table->integer('billing_address_id')->unsigned()->nullable();
            $table->string('track_code')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
        });

        $path = __DIR__ . '/../../assets/countries.json';
        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $country) {
            Country::create([
                'code' => strtolower(array_get($country, 'alpha2Code')),
                'name' => array_get($country, 'name'),
                'phone_code' => array_get($country, 'callingCodes.0'),
                'currency_code' => array_get($country, 'currencies.0.code'),
                'currency_symbol' => array_get($country, 'currencies.0.symbol'),
                'lang_code' => array_get($country, 'languages.0.name'),
            ]);
        }

        Schema::create('menu_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('identifier')->nullable()->default(null);
            $table->tinyInteger('is_default')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('menus', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_group_id')->unsigned();
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('route')->nullable()->default(null);
            $table->string('params')->nullable()->default(null);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('cascade');
        });

        Schema::create('tax_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('tax_rates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->float('rate', 10, 6);
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned()->nullable()->default(null);
            $table->integer('postcode')->nullable()->default(null);
            $table->enum('rate_type', ['PERCENTAGE', 'FIXED'])->default('PERCENTAGE');
            $table->enum('applied_with', ['SHIPPING', 'BILLING', 'STORE'])->default('SHIPPING');
            $table->timestamps();
        });

        $countryModel = Country::whereCode('nz')->first();
        $countryModel->update(['is_active' => 1]);
        $siteCurrency = SiteCurrency::create([
            'name' => 'NZ Dollars',
            'code' => 'NZD',
            'symbol' => '$',
            'conversion_rate' => 1,
            'status' => 'ENABLED'
        ]);

        Configuration::create([
            'configuration_key' => 'general_site_currency',
            'configuration_value' => $siteCurrency->id,
        ]);

        Configuration::create([
            'configuration_key' => 'tax_default_country',
            'configuration_value' => $countryModel->id,
        ]);

        Configuration::create([
            'configuration_key' => 'tax_enabled',
            'configuration_value' => 1,
        ]);

        Configuration::create([
            'configuration_key' => 'tax_percentage',
            'configuration_value' => 15,
        ]);

        Configuration::create([
            'configuration_key' => 'general_site_title',
            'configuration_value' => 'AvoRed an Laravel Ecommerce'
        ]);
        Configuration::create([
            'configuration_key' => 'general_site_description',
            'configuration_value' => 'AvoRed is a free open-source e-commerce application development platform written in PHP based on Laravel. Its an ingenuous and modular e-commerce that is easily customizable according to your needs, with a modern responsive mobile friendly interface as default'
        ]);
        Configuration::create([
            'configuration_key' => 'general_site_description',
            'configuration_value' => 'AvoRed Laravel Ecommerce
        ']);

        $accountMenuGroup = MenuGroup::create([
            'name' => 'My Account',
            'identifier' => 'my-account'
        ]);

        Menu::create([
            'name' => 'Account Overview',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.home',
        ]);
        Menu::create([
            'name' => 'Edit Account',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.edit',
        ]);
        Menu::create([
            'name' => 'Upload Image',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.upload-image',
        ]);
        Menu::create([
            'name' => 'My Orders',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.order.list',
        ]);
        Menu::create([
            'name' => 'My Addresses',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.address.index',
        ]);
        Menu::create([
            'name' => 'My Wishlist',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.wishlist.list',
        ]);
        Menu::create([
            'name' => 'Change Password',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'my-account.change-password',
        ]);
        Menu::create([
            'name' => 'Logout',
            'menu_group_id' => $accountMenuGroup->id,
            'route' => 'logout',
        ]);
        
        $menuGroup = MenuGroup::create([
            'name' => 'Main Menu',
            'identifier' => 'main-menu',
            'is_default' => 1
        ]);

        
        Menu::create([
            'name' => 'My Account',
            'menu_group_id' => $menuGroup->id,
            'route' => 'my-account.home',
            'sort_order' => 400
        ]);
        Menu::create([
            'name' => 'Cart',
            'menu_group_id' => $menuGroup->id,
            'route' => 'cart.view',
            'sort_order' => 500
        ]);
        Menu::create([
            'name' => 'Checkout',
            'menu_group_id' => $menuGroup->id,
            'route' => 'checkout.index',
            'sort_order' => 600
        ]);
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
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');

        Schema::dropIfExists('attributes');

        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('product_order');
        Schema::dropIfExists('orders');

        Schema::dropIfExists('oauth_personal_access_clients');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_auth_codes');

        Schema::dropIfExists('admin_password_resets');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('configurations');

        Schema::dropIfExists('pages');
        Schema::dropIfExists('wishlists');

        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('languages');
    }
}
