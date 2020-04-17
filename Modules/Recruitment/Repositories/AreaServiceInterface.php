<?php
/**
 * Created by PhpStorm.
 * Author: HongXunPan
 * Email: me@kangxuanpeng.com
 * Date: 2020/4/18
 * Time: 3:12
 */

namespace Modules\Recruitment\Repositories;


use App\Repositories\BaseRepositoryInterface;

interface AreaServiceInterface extends BaseRepositoryInterface
{
    public function getChildrenArea($parentId, $level = 1): array;

}
