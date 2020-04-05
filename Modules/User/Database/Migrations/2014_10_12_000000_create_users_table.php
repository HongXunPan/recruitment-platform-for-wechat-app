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
            //用户资料
            $table->id();
            $table->string('name')->unique()->comment('用户id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile', 20)->nullable()->unique();
            $table->unsignedTinyInteger('status')->default(0)->index()->comment('状态');
            //个人资料
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('real_name')->nullable()->comment('姓名');
            $table->text('avatar')->nullable()->comment('微信头像');
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别默认未知 01男2女');
            $table->json('location')->nullable()->comment('当前地理信息');

            //微信字段
            $table->string('openid')->nullable()->comment('微信开放id');
            $table->string('union_id')->nullable()->comment('微信union_id');
            $table->string('weapp_session_key')->nullable()->comment('微信session_key');

            //laravel 字段
            $table->string('api_token', 100)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
