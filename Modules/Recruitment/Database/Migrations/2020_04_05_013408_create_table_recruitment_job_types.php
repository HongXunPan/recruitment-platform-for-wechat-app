<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecruitmentJobTypes extends Migration
{
    protected $tableName = 'recruitment_job_types';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('');
            $table->unsignedTinyInteger('level')->index()->default(0)->comment('等级 1标题2类型');

            $table->unsignedInteger('parent_id')->default(0)->index();
            $table->text('icon')->nullable();
            $table->unsignedInteger('sort')->default(0);

            $table->timestamps();
        });

        foreach ($this->data as $title => $typeData) {
            $titleId = DB::table($this->tableName)->insertGetId([
                'name' => $title,
                'level' => 1,
            ]);
            foreach ($typeData as $type) {
                DB::table($this->tableName)->insertGetId([
                    'name' => $type,
                    'parent_id' => $titleId,
                    'level' => 2,
                ]);
            }
        }
    }

    protected $data = [
        '简单易做' => [
            '派单','调研'
        ],
        '市场推广' => [
            '销售','促销','导购'
        ],
        '餐饮服务' => [
            '服务员','送餐员'
        ],
        '展会演出' => [
            '安保','礼仪','演出','模特'
        ],
        '职能技术' => [
            '翻译','客服','家教','文员','设计','实习','网络编辑','美工'
        ],
        '其他' => [
            '其他','校内','临时工','快递分拣'
        ],
    ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
