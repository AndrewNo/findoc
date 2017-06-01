<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->integer('account_id')->references('id')->on('accounts');
            $table->integer('payer_id')->references('id')->on('payers')->nullable();
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
        Schema::dropIfExists('incomes');
    }
}
