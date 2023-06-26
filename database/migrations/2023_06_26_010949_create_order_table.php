<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn')->default('')->comment('订单号');
            $table->unsignedBigInteger('product_id')->comment('产品ID');
            $table->string('name')->default('')->comment('产品名称');
            $table->text('pic')->comment('产品图片');
            $table->string('num')->default('')->comment('产品数量');
            $table->string('money_type')->default('')->comment('币别：USD美元TWD台币HKD港币');
            $table->decimal('money')->comment('金额');
            $table->string('first_name')->default('')->comment('姓氏');
            $table->string('last_name')->default('')->comment('名字');
            $table->string('mobile')->default('')->comment('手机号码');
            $table->string('address')->default('')->comment('收货地址');
            $table->tinyInteger('status')->comment('状态：0、未支付；1、已支付；2、已发货');
            $table->string('logistics_company')->default('')->comment('物流公司');
            $table->string('logistics_number')->default('')->comment('物流单号');
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
        Schema::dropIfExists('order');
    }
}
