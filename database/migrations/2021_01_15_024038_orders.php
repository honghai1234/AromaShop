<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->id()->comment('auto_increment');

            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->date('order_date');
            $table->date('required_date');
            $table->date('shipped_date');
            $table->boolean('delete_flg');
            $table->timestamp('created_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
