<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories')->nullable();
            $table->integer('subcategory_id')->references('id')->on('subcategories')->nullable();
            $table->integer('account_id')->references('id')->on('accounts');
            $table->integer('seller_id')->references('id')->on('sellers')->nullable();
            $table->float('total_sum')->default(0);
            $table->string('currency');
            $table->text('comment')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('outcomes');
    }
}
