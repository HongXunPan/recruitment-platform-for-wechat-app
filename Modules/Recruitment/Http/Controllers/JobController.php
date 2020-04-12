<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
