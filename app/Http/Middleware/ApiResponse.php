<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (is_array($response)) {
            return $response;
        }

        //非正常返回
        if ($response->getStatusCode() !== 200) {
            $return = [
                'code' => 9999,
                'msg' => '服务器错误',
                'data' => ['http_code' => $response->getStatusCode()],
            ];
            $response = $response instanceof JsonResponse ? $response->setData($return) : $response->setContent($return);
            return $response;
        }

        // 执行动作
        $oriData = $response->getOriginalContent();
        $content = json_decode($response->getContent(), true) ?? $oriData;
        $content = is_array($oriData) ? $oriData : $content;

        //返回结构默认值
        $return['code'] = $content['code'] ?? 0;
        $return['msg'] = $content['msg'] ?? 'success';

        if ($return['code'] !== 0) {
            //异常时直接返回
            return $response;
        }

        $return['data'] = $content['data'] ?? [];
        if (!isset($content['code']) && !isset($content['msg'])) {
            //如果返回体没有code和msg 整个数组为返回结构, 自带data 值则直接取data
            $return['data'] = $content['data'] ?? $content;
        }

        $response = $response instanceof JsonResponse ? $response->setData($return) : $response->setContent($return);
        return $response;
    }
}
