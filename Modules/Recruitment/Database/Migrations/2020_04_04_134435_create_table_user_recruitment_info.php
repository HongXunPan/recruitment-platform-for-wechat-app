<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\User\Enums\UserWorkEnum;

class CreateTableUserRecruitmentInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recruitment_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->unsignedInteger('area_id')->nullable()->comment('所在城市');
            $table->date('birth_date')->nullable()->comment('生日');
            $table->string('height', 10)->nullable()->comment('身高');
            $table->unsignedTinyInteger('education_status')->nullable()->comment('教育状态 1在读 2已毕业');
            $table->unsignedTinyInteger('highest_degree')->nullable()->comment('最高学历');

            $table->string('qq', 100)->nullable()->comment('qq账号');
            $table->string('wechat', 100)->nullable()->comment('微信账号');

            //工作期望 工作类型（长短期/周末/实习）、工作时间（工作日/周末/节假日） *去除可上班时间

            //[]数组形式 逗号分隔 可用laravel 7 自定义 Eloquent 转化解析CastsAttributes
            $table->string('hope_work_type')->default(UserWorkEnum::HOPE_WORK_TYPE_NO_LIMIT)->comment('期望工作类型');
            $table->string('hope_work_time')->default(UserWorkEnum::HOPE_WORK_TIME_NO_LIMIT)->comment('期望工作时间');

            $table->unsignedTinyInteger('can_full_time')->comment('可否全职');

            //自我评价
            $table->text('self_intro')->nullable();

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
        Schema::dropIfExists('user_recruitment_info');
    }
}
