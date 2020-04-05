<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Recruitment\Enums\JobEnum;

class CreateTableRecruitmentJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->index();

            $table->string('title')->comment('标题');
            $table->text('content')->nullable()->comment('工作内容');

            $table->unsignedBigInteger('price')->comment('价格 单位是分');
            $table->string('unit', '10')->default('天')->comment('价格单位');

            $table->unsignedBigInteger('area_id')->comment('工作地点区域');
            $table->text('tag_ids')->nullable()->comment('标签');
            $table->text('welfare_ids')->nullable()->comment('工作福利');
            $table->text('job_type_ids')->nullable()->comment('工作类型');
            $table->string('work_circles')->default(JobEnum::WORK_CIRCLE_NO_LIMIT)->comment('工作周期');

            $table->unsignedTinyInteger('sex_require')->default(JobEnum::SEX_NOT_LIMIT)->comment('性别要求 0不限 1男2女');
            $table->string('work_time')->default(JobEnum::WORK_TIME_NO_LIMIT)->comment('上班时间 逗号分隔 0不限');
            $table->text('other_require')->nullable()->comment('补充描述 选项:要求说明 每项用英文逗号隔开 ');

            $table->json('location')->nullable()->comment('地址信息');
            $table->unsignedInteger('status')->default(JobEnum::STATUS_NORMAL)->comment('兼职状态 0正常 1下架');
            $table->unsignedBigInteger('view_count')->default(0)->comment('浏览次数');
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
        Schema::dropIfExists('recruitment_jobs');
    }
}
