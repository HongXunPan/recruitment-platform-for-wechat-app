<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/10
 * Time: 0:32
 */

namespace App\Repositories;


class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var string
     */
    private $error='';

    /**
     * @var string
     */
    private $msg='';

    /**
     * 设置错误
     * @param $msg
     * @return boolean
     */
    protected function error($msg = '成功'): bool
    {
        $this->error = $msg;
        return false;
    }

    /**
     * 设置成功
     * @param $msg
     * @return boolean
     */
    protected function success($msg = '失败'): bool
    {
        $this->msg = $msg;
        return true;
    }

    /**
     * 获取消息
     * @return string
     */
    public function getMessage():string
    {
        return $this->msg;
    }

    /**
     * @return string
     */
    public function getError():string
    {
        return $this->error;
    }


}