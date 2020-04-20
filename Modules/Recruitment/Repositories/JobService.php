<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 13:33
 */

namespace Modules\Recruitment\Repositories;

use App\Exceptions\ApiException;
use App\Repositories\BaseRepository;
use Cblink\Region\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Recruitment\Entities\Area;
use Modules\Recruitment\Entities\Job;
use Modules\Recruitment\Entities\JobType;
use Modules\Recruitment\Enums\JobEnum;

class JobService extends BaseRepository implements JobServiceInterface
{
    /**
     * @param array $fields
     * @param array $where
     * @param int $count
     * @param int $page
     * @param int $pageSize
     * @param int $sort
     * @return Collection|Job[]
     */
    public function getJobList(array $fields = [],array $where = [], &$count = 0, int $page = 1, int $pageSize = 15, int $sort = JobEnum::SORT_DEFAULT)
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
            $query->where(function ($q) use ($where) {
                /** @var Job $q*/
                if (isset($where['area_ids'])) {
                    $q->whereIn('area_id', $where['area_ids']);
                }
                if (isset($where['sex_require'])) {
                    $q->whereSexRequire($where['sex_require']);
                }
                if (isset($where['work_time'])) {
                    $q->whereIn('work_time', $where['work_time']);
                }
            });
        }

        switch ($sort) {
            case JobEnum::SORT_DEFAULT:
                $query->orderBy('sort_score', 'desc');
                break;
            case JobEnum::SORT_NEWEST:
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }
        $query->orderBy('id', 'desc');
        $count = $query->count();

        $query->forPage($page, $pageSize);
        return $query->get();
    }

    /**
     * 格式化工作列表
     * @param Collection $jobList
     * @param array $fields
     * @return array
     * @throws ApiException
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
     * @return array|mixed|string
     * @throws ApiException
     */
    public function formatJobField(Job $job, $field = '')
    {
        if (empty($field)) {
            throw new ApiException(ApiException::TYPE_SERVER_ERROR, 'can not get empty property from Job');
        }
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
                $value = $job->$field ?? '';
                break;
        }
        return $value;
    }

    public function getJobTypeTree(): array
    {
        $typeList = JobType::whereLevel(1)->with('children')->get();
        $typeTree = [];
        if (!empty($typeList)) {
            /** @var JobType $type */
            foreach ($typeList as $type) {
                $children = [];
                /** @var JobType $child */
                foreach ($type->children as $child) {
                    $children[] = [
                        'id' => $child['id'],
                        'name' => $child['name'],
                    ];
                }
                $typeTree[] = [
                    'id' => $type['id'],
                    'name' => $type['name'],
                    'icon' => $type['icon'] ?? '',
                    'children' => $children
                ];
            }
        }
        return $typeTree;
    }


}
