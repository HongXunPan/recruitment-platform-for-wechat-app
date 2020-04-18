<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 13:31
 */
namespace Modules\Recruitment\Repositories;

use App\Repositories\BaseRepositoryInterface;
use Modules\Recruitment\Entities\Job;
use Modules\Recruitment\Enums\JobEnum;

interface JobServiceInterface extends BaseRepositoryInterface
{
    public function getJobList(array $fields = [],array $where = [], &$count = 0, int $page = 1, int $pageSize = 15, int $sort = JobEnum::SORT_DEFAULT);

    public function formatJobList($jobList, $fields = []): array ;

    public function formatJobField(Job $job, $field = '');

    public function getJobTypeTree(): array ;

}
