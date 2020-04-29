<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Recruitment\Entities\Job;
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
            'work_time' => 'array|in:' . implode(',', array_keys(JobEnum::$workTimeMap)),
            'work_circle' => 'int|in:' . implode(',', array_keys(JobEnum::$workCircleMap)),
            'job_type_ids' => 'array|in:' . implode(',', JobType::whereLevel(2)->get()->pluck('id')->toArray()),
            'keywords' => 'string',
        ]);
        $page = (int)$request->page ?: 1;
        $pagesize = (int)$request->pagesize ?: 15;

        //筛选 filter
        $where = [];
        //$area_id
        if (count($request->area_ids) > 0) {
            /** @var AreaServiceInterface $areaService */
            $areaService = app(AreaServiceInterface::class);
            $where['area_ids'] = $areaService->getChildrenAreaId($request->area_ids);
        }
        if (isset($request->sex_require)) {
            $where['sex_require'] = $request->sex_require;
        }
        if (isset($request->work_time)) {
            //单选不限的时候，真的不限制筛选
            if (!in_array(JobEnum::WORK_TIME_NO_LIMIT, $request->work_time) || count($request->work_time) !== 1) {
                $where['work_time'] = $request->work_time;
            }
        }
        if (isset($request->work_circle) && $request->work_time !== JobEnum::WORK_CIRCLE_NO_LIMIT) {
            $where['work_circle'] = $request->work_circle;
        }
        if (isset($request->job_type_ids)) {
            $where['job_type_ids'] = $request->job_type_ids;
        }
        //search
        if (isset($request->keywords)) {
            $where['keywords'] = $request->keywords;
        }


        //排序 sort
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

    public function jobDetail($id)
    {
        $job = Job::findOrFail($id);
        $data = $this->jobService->formatJob($job, ['title', 'money', 'area_name', 'view_count', 'created_at', 'content'
        , 'tags', 'welfare', 'type', 'work_circles', 'sex_require', 'work_time', 'other_require', ]);

        if (!empty($data['tags'])) {
            $tags = array_slice($data['tags']->toArray(), 0, 5);
            $newTags = [];
            foreach ($tags as $tag) {
                $newTags[] = [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                ];
            }
            $data['tags'] = $newTags;
        }
        $data['created_at'] = $data['created_at']->format('Y-m-d');
        $data['tips'] = JobEnum::JOB_DETAIL_TIPS;

        if (!empty($data['type'])) {
            $types = array_slice($data['type']->toArray(), 0, 3);
            $newTypes = [];
            foreach ($types as $type) {
                $newTypes[] = [
                    'id' => $type['id'],
                    'type' => $type['name'],
                ];
            }
            $data['type'] = $newTypes;
        }

        $data['sex_require'] = JobEnum::$sexRequireMap[$data['sex_require']];

        if (!empty($data['welfare'])) {
            $welfares = array_slice($data['welfare']->toArray(), 0, 5);
            $newWelfares = [];
            foreach ($welfares as $welfare) {
                $newWelfares[] = [
                    'id' => $welfare['id'],
                    'welfare' => $welfare['welfare'],
                    'image' => '',
                ];
            }
            $data['welfare'] = $newWelfares;
        }

        $data['work_circles'] = JobEnum::$workCircleMap[$data['work_circles']];
        $data['work_time'] = JobEnum::$workTimeMap[$data['work_time']];

        $otherRequires = explode(',', $data['other_require']);
        $newOtherRequires = [];
        foreach ($otherRequires as $otherRequire) {
            //$otherRequire 包含: 转换成 key => value
            list($key, $value) = explode(':', $otherRequire);
            $newOtherRequires[$key] = $value;
        }

        $data['other_require'] = $newOtherRequires;

        return $data;
    }
}
