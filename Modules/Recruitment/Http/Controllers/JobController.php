<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        $this->validate($request, [
            'page' => 'int',
            'pagesize' => 'int',
            'area_ids' => 'array',
            'sort' => 'int|in:' . implode(',', array_keys(JobEnum::$sortMap)),
            'sex_require' => 'int|in:' . implode(',', array_keys(JobEnum::$sexRequireMap)),
            'work_time' => 'array|in:' . implode(',',array_keys(JobEnum::$workTimeMap)),

        ]);
        $page = (int)$request->page ?: 1;
        $pagesize = (int)$request->pagesize ?: 15;

        //todo 筛选
        $where = [];
        //$area_id
        if (count($request->area_ids) > 0) {
            /** @var AreaServiceInterface $areaService */
            $areaService = app(AreaServiceInterface::class);
            $where['area_ids'] = $areaService->getChildrenAreaId($request->area_ids);
        }
        if (isset($request->sex_require)) {
            //        $sex_require
            $where['sex_require'] = $request->sex_require;
        }
        if (isset($request->work_time)) {
            //单选不限的时候，真的不限制筛选
            if (!in_array(JobEnum::WORK_TIME_NO_LIMIT, $request->work_time) || count($request->work_time) !== 1) {
                $where['work_time'] = $request->work_time;
            }
        }
        //sort
        $sort = $request->sort ?: 1;

        $jobList = $this->jobService->getJobList([], $where, $count, $page, $pagesize, $sort);
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
        $area = $areaService->getChildrenAreaTree($currentAreaId, 1);

        //排序
        $sort = JobEnum::$sortMap;
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
