<?php

namespace Modules\Recruitment\Database\Seeders;

use Illuminate\Database\Seeder;

class RecruitmentJobTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('recruitment_job_types')->delete();

        \DB::table('recruitment_job_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => '简单易做',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => '派单',
                    'level' => 2,
                    'parent_id' => 1,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => '调研',
                    'level' => 2,
                    'parent_id' => 1,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => '市场推广',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => '销售',
                    'level' => 2,
                    'parent_id' => 4,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => '促销',
                    'level' => 2,
                    'parent_id' => 4,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => '导购',
                    'level' => 2,
                    'parent_id' => 4,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => '餐饮服务',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => '服务员',
                    'level' => 2,
                    'parent_id' => 8,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => '送餐员',
                    'level' => 2,
                    'parent_id' => 8,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => '展会演出',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => '安保',
                    'level' => 2,
                    'parent_id' => 11,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => '礼仪',
                    'level' => 2,
                    'parent_id' => 11,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => '演出',
                    'level' => 2,
                    'parent_id' => 11,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => '模特',
                    'level' => 2,
                    'parent_id' => 11,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => '职能技术',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => '翻译',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => '客服',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => '家教',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => '文员',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => '设计',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => '实习',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            22 =>
                array(
                    'id' => 23,
                    'name' => '网络编辑',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => '美工',
                    'level' => 2,
                    'parent_id' => 16,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            24 =>
                array(
                    'id' => 25,
                    'name' => '其他',
                    'level' => 1,
                    'parent_id' => 0,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            25 =>
                array(
                    'id' => 26,
                    'name' => '其他',
                    'level' => 2,
                    'parent_id' => 25,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            26 =>
                array(
                    'id' => 27,
                    'name' => '校内',
                    'level' => 2,
                    'parent_id' => 25,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            27 =>
                array(
                    'id' => 28,
                    'name' => '临时工',
                    'level' => 2,
                    'parent_id' => 25,
                    'icon' => NULL,
                    'sort' => 0,
                ),
            28 =>
                array(
                    'id' => 29,
                    'name' => '快递分拣',
                    'level' => 2,
                    'parent_id' => 25,
                    'icon' => NULL,
                    'sort' => 0,
                ),
        ));


    }
}