<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('名称');
            $table->text('pic')->comment('照片');
            $table->decimal('money')->comment('金额');
            $table->string('money_type')->default('')->comment('币别：USD美元TWD台币HKD港币');
            $table->string('num')->default('')->comment('数量');
            $table->string('uid')->default('')->comment('uid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
