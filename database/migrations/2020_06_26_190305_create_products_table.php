<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_image');
            $table->string('product_file');
            $table->text('product_description');
            $table->string('product_level')->nullable();
            $table->unsignedInteger('vendor_id');
            $table->string('admin_name');
            $table->integer('featured')->nullable();
            $table->integer('best_seller')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
