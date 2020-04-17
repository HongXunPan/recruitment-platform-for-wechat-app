<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Recruitment\Entities\JobType;
use Modules\Recruitment\Enums\JobEnum;
use Modules\Recruitment\Repositories\AreaService;
use Modules\Recruitment\Repositories\AreaServiceInterface;
use Modules\Recruitment\Repositories\JobServiceInterface;

class JobController extends Controller
{
    private $jobService;

    public function __construct(JobServiceInterface $jobService)
    {
        $this->jobService = $jobService;
    }

    public function list(Request $request)
    {
        $page = (int)$request->page ?: 1;
        $pagesize = (int)$request->pagesize ?: 15;
        //$area_id
        $jobList = $this->jobService->getJobList([], [], $count, $page, $pagesize);

        $list = $this->jobService->formatJobList($jobList, ['id', 'title', 'money', 'first_tag_name', 'welfare_name_list', 'area_name', 'created_at']);
        foreach ($list as &$data) {
            if (count($data['welfare_name_list']) > 3) {
                $data['welfare_name_list'] = array_slice($data['welfare_name_list'], 0, 3);
            }
            $data['created_at'] = $data['created_at']->diffForHumans();
        }

        return $this->listData($list, $page, $count);
    }

    public function listFilterCondition(Request $request)
    {
        //类型
        $typeList = $this->jobService->getJobTypeTree();

        $this->validate($request, [
            'current_area_id' => 'int',
        ]);
        $currentAreaId = $request->input('current_area_id', 0);

        //区域
        /** @var AreaServiceInterface $areaService */
        $areaService = app(AreaServiceInterface::class);
        $area = $areaService->getChildrenArea($currentAreaId, 1);

        //排序
        $sort = [
            1 => '综合排序',
            2 => '最新发布',
            3 => '离我最近',
        ];


        array_walk($sort, 'indexed_array_to_json', ['sort', 'name']);
        $sort = array_values($sort);
        //筛选
        $sexRequireMap = JobEnum::$sexRequireMap;
        array_walk($sexRequireMap, 'indexed_array_to_json', ['sex_require', 'name']);

        $workTimeMap = JobEnum::$workTimeMap;
        array_walk($workTimeMap, 'indexed_array_to_json', ['work_time', 'name']);

        $workCircleMap = JobEnum::$workCircleMap;
        array_walk($workCircleMap, 'indexed_array_to_json', ['work_circle', 'name']);

        $filter = [
            ['key' => 'sex_require', 'name' => '性别要求', 'can_multi' => false, 'children' => $sexRequireMap],
            ['key' => 'work_time', 'name' => '上班时间', 'can_multi' => true, 'children' => $workTimeMap],
            ['key' => 'work_circle', 'name' => '工作周期', 'can_multi' => false, 'children' => $workCircleMap],
        ];

        return ['type' => $typeList, 'area' => $area, 'sort' => $sort, 'filter' => $filter];
    }
}
