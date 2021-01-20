<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->id()->comment('auto_increment');

            $table->string('name');
            $table->string('image');
            $table->string('icon');
            $table->string('description');
            $table->integer('amount');
            $table->integer('price');
            $table->integer('color')->comment('1:red 2:yellow 3:blue');
            $table->integer('brands')->comment('1:apple 2:asus 3:samsung');
            $table->boolean('delete_flg');
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('categorie_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('update_at')->nullable();


            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('categorie_id')->references('id')->on('categories');
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
