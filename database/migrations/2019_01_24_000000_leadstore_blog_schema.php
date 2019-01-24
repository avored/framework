<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadstoreOrdersSchema extends Migration
{

    public function up()
    {
        Schema::create('blog_posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->string('featured_image')->nullable()->default(null);
            $table->string('featured_image_social')->nullable()->default(null);
            $table->timestamps();
        });
        Schema::create('blog_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('category_blog_post', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_blog_post');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blog_posts');

    }

}
