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
            $table->bigIncrements('product_id')->comment('产品id');
            $table->bigInteger('uid')->default(0)->comment('用户id');
            $table->string('name', 20)->default('')->comment('产品名称');
            $table->tinyInteger('product_type', false, true)->default(1)->comment('产品类型: 1.A产品,2.B产品,3.C产品');
            $table->string('introduction', 50)->comment('产品简介');
            $table->integer('created_at', false, true)->default(0)->comment('创建时间');
            $table->integer('updated_at', false, true)->default(0)->comment('更新时间');
            $table->integer('deleted_at', false, true)->default(0)->comment('删除时间');
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `products` comment '产品表'"); // 表注释
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
