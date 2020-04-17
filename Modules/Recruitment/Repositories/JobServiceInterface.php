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

interface JobServiceInterface extends BaseRepositoryInterface
{
    public function getJobList($fields = [], $where = [], &$count = 0, $page = 1, $pageSize = 15);

    public function formatJobList($jobList, $fields = []): array ;

    public function formatJobField(Job $job, $field = '');

    public function getJobTypeTree(): array ;

}
