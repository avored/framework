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
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
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

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('category_translations', function (Blueprint $table) {
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
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
        
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_password_resets');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('languages');
        
        Schema::enableForeignKeyConstraints();
    }
}
