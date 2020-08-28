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
                if (isset($where['work_circle'])) {
                    $q->whereWorkCircles($where['work_circle']);
                }
                if (isset($where['job_type_ids'])) {
                    $sql = DB::raw('FIND_IN_SET(?,job_type_ids)');
                    $sql .= str_repeat(DB::raw(' or FIND_IN_SET(?,job_type_ids)'), count($where['job_type_ids']) -1);
                    $q->whereRaw('(' . $sql . ')', $where['job_type_ids']);
                }
                if (isset($where['keywords'])) {
                    //后续做拆分搜索 eg:Elasticsearch分词
                    $q->whereRaw(DB::raw('concat(title,content) like \'%'.$where['keywords'].'%\''));
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
            $formatJob = $this->formatJob($job, $fields);
            $data[] = $formatJob;
        }
        return $data;
    }

    /**
     * @param Job $job
     * @param array $fields
     * @return array
     * @throws ApiException
     */
    public function formatJob(Job $job, $fields = []): array
    {
        $newJob = [];
        foreach ($fields as $field) {       //遍历字段赋值
            if (!empty($field)) {
                $newJob[$field] = $this->formatJobField($job, $field);
            }
        }
        return $newJob;
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

    public function getJobDetail($id)
    {
        $job = Job::findOrFail($id);
        $data = $this->formatJob($job, ['title', 'money', 'area_name', 'view_count', 'created_at', 'content'
            , 'tags', 'welfare', 'type', 'work_circles', 'sex_require', 'work_time', 'other_require', ]);

        if (!empty($data['tags'])) {
            $tags = $data['tags']->toArray();
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
            $types = $data['type']->toArray();
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
            $welfares = $data['welfare']->toArray();
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
