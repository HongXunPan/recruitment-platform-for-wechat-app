<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/11
 * Time: 16:28
 */

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $data;

    public $needReport = false;

    const TYPE_PARAM_REQUIRE = -1;
    const TYPE_PARAM_ERROR = -2;

    const TYPE_RESULT_FAIL = 10;     //操作失败
    const TYPE_SERVER_ERROR = 9999;


    //需要记录到日志文件的类型
    public static $doReportTypes = [
        self::TYPE_SERVER_ERROR
    ];

    public function __construct(int $exceptionType, string $message = 'error', bool $needReport = false, array $data = [])
    {
        $this->needReport = $needReport;
        if (!$needReport && in_array($exceptionType, self::$doReportTypes)) {
            $this->needReport = true;
        }
        $this->data = $data;
        parent::__construct($message, $exceptionType);
    }

    public function render()
    {
        $content = [
            'code' => $this->code,
            'msg' => $this->message,
            'data' => $this->data ?? [],
        ];

        return response()->json($content);
    }

}