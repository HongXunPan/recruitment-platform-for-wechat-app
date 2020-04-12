<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/10
 * Time: 0:30
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * 获取错误信息
     * @return string
     */
    public function getError():string ;

    /**
     * 获取成功信息
     * @return string
     */
    public function getMessage():string ;
}