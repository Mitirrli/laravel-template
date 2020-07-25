<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id')->comment('用户id');
            $table->string('name', 20)->default('')->comment('用户名称');
            $table->char('mobile', 11)->default('')->comment('手机号');
            $table->tinyInteger('sex', false, true)->default(0)->comment('用户性别: 0未知，1男，2女');
            $table->tinyInteger('type', false,true)->default(0)->comment('用户类型: 0非付费用户，1付费用户');
            $table->integer('created_at', false, true)->default(0)->comment('创建时间');
            $table->integer('updated_at', false, true)->default(0)->comment('更新时间');
            $table->integer('deleted_at', false, true)->default(0)->comment('删除时间');
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` comment '用户表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
