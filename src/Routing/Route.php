<?php

namespace Painkill2r\InflearnLectureLib\Routing;

use Painkill2r\InflearnLectureLib\Http\Request;
use Painkill2r\InflearnLectureLib\Routing\RequestContext;

/**
 * 라우트에 관련된 처리
 */
class Route
{
    /**
     * @var array $contexts RequestContext 객체 배열
     */
    private static $contexts = [];

    /**
     * 요청 정보를 저장하는 메소드
     *
     * @param string $method 요청 Method
     * @param string $path 요청 URL
     * @param function $handler 요청 처리 핸들러(함수)
     * @param array $middlewares 미들웨어 목록
     * @return void
     */
    public static function add($method, $path, $handler, $middlewares = [])
    {
        self::$contexts[] = new RequestContext($method, $path, $handler, $middlewares);
    }

    /**
     * 요청 처리 실행 메소드
     * 만약, 미들웨어가 등록되어 있다면 요청을 처리하기 전에 먼저 미들웨어 처리를 진행한다.
     *
     * @return false|mixed|void
     */
    public static function run()
    {
        foreach (self::$contexts as $context) {
            if ($context->method == strtolower(Request::getMethod()) && is_array($urlParams = $context->match(Request::getPath()))) {
                if ($context->runMiddlewares()) {
                    return \call_user_func($context->handler, ...$urlParams);
                }

                return false;
            }
        }
    }
}