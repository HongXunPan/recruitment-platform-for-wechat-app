<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 13:33
 */

namespace Modules\Recruitment\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Recruitment\Entities\Job;

class JobService extends BaseRepository implements JobServiceInterface
{
    /**
     * @param array $fields
     * @param array $where
     * @param int $count
     * @param int $page
     * @param int $pageSize
     * @return Collection|static[]
     */
    public function getJobList($fields = [], $where = [], &$count = 0, $page = 1, $pageSize = 15)
    {
        /** @var Job $query */
        $query = Job::query();
        if (!empty($fields)) {
            if (!is_array($fields)) {
                $fields = [$fields];
            }
            $query->select($fields);
        }
        if (!empty($where)) {
            $query->where($where);
        }

        $query->orderBy('created_at', 'desc');
        $query->orderBy('id', 'desc');
        $count = $query->count();

        $query->forPage($page, $pageSize);
        $jobList = $query->get();

        return $jobList;
    }

    /**
     * 格式化工作列表
     * @param Collection $jobList
     * @param array $fields
     * @return array
     */
    public function formatJobList($jobList, $fields = []): array
    {
        $data = [];
        /** @var Job $job */
        foreach ($jobList as $job) {
            $formatJob = [];
            foreach ($fields as $field) {       //遍历字段赋值
                if (!empty($field)) {
                    $formatJob[$field] = $this->formatJobField($job, $field);
                }
            }
            $data[] = $formatJob;
        }
        return $data;
    }

    /**
     * 格式化工作字段
     * @param Job $job
     * @param string $field
     * @return mixed
     */
    public function formatJobField(Job $job, $field = '')
    {
        $value = '';
        switch ($field) {
            case 'area_name':
                $value = $job->area->name;
                break;
            case 'money':
                $value = money_format_from_db($job->price, 2, '.', '') . '元/' . $job->unit;
                break;
            case 'welfare_name_list':
                $welfares = [];
                foreach ($job->welfare as $welfare) {
                    $welfares[] = $welfare->welfare;
                }
                $value = $welfares;
                break;
            case 'first_tag_name':
                $value = empty($job->tags) ? '' : $job->tags[0]->name;
                break;
            default:
                if (!empty($field)) {
                    $value = $job->$field ?? '';
                }
                break;
        }
        return $value;
    }
}