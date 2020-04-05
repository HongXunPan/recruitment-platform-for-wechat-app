<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserIdentity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_identity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->string('real_name', 30);
            $table->string('no', 30)->comment('身份证号码');
            $table->string('image_front')->comment('正面 人像');
            $table->string('image_back')->comment('反面 国徽');

            $table->string('school', 100);
            $table->date('graduate_at')->comment('毕业年月');

            $table->unsignedTinyInteger('status')->comment('认证状态');
            $table->timestamps();

            $table->index(['real_name', 'no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_identity');
    }
}
