<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('is_super_admin')->nullable()->default(null);
            $table->uuid('role_id')->nullable()->default(null);
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

        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->uuid('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->uuid('permission_id')->nullable()->default(null);
            $table->uuid('role_id')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
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
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('property_dropdown_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('property_id');
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
        });
        Schema::create('attributes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('display_as', ['IMAGE', 'TEXT'])->default('TEXT');
            $table->timestamps();
        });
        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('attribute_id');
            $table->string('display_text');
            $table->string('path')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
        });
        Schema::create('configurations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable()->default(null);
            $table->text('value')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
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

        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image_path')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('configurations');
        Schema::dropIfExists('attribute_dropdown_options');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('property_dropdown_options');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
            $table->dropColumn('parent_id');
        });
        Schema::dropIfExists('categories');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('admin_password_resets');
    }
}
