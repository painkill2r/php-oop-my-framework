<?php

namespace Painkill2r\InflearnLectureLib\Routing;

/**
 * 요청에 대한 정보를 보유
 */
class RequestContext
{

    /**
     * @var string $method 요청 Method
     */
    public $method;

    /**
     * @var string $path 요청 URL
     */
    public $path;

    /**
     * @var function $handler 요청을 처리할 핸들러(함수)
     */
    public $handler;

    /**
     * @var array|mixed $middlewares 미들웨어 목록
     */
    public $middlewares;

    /**
     * RequestContext 생성자
     *
     * @param string $method 요청 Method
     * @param string $path 요청 URL
     * @param function $handler 요청 처리 핸들러
     * @param array $middlewares 미들웨어 목록
     */
    public function __construct($method, $path, $handler, $middlewares = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    /**
     * 요청 URL과 RequestContext 객체의 $path를 비교하여 핸들러(함수)에 전달할 아규먼트를 생성하는 메소드
     * 예1) $this->path = /posts, $url = /posts
     * 예2) $this->path = /posts/{id}, $url = /posts/1
     *
     * @param string $url 요청 URL
     * @return array|null
     */
    public function match($url)
    {
        $urlParts = explode("/", $url);
        $urlPatternParts = explode("/", $this->path);

        if (count($urlParts) === count($urlPatternParts)) {
            $urlParams = [];

            foreach ($urlPatternParts as $key => $part) {
                if (preg_match("/^\{.*\}/", $part)) {
                    $urlParams[$key] = $part;
                } else {
                    if ($urlParts[$key] != $part) {
                        return null;
                    }
                }
            }

            return count($urlParams) < 1 ? [] : array_map(fn($k) => $urlParts[$k], array_keys($urlParams));
        }
    }

    /**
     * RequestContext 객체에 등록되어 있는 미들웨어를 실행하고 그 결과를 Boolean 값으로 반환하는 메소드
     *
     * @return bool
     */
    public function runMiddlewares()
    {
        foreach ($this->middlewares as $middleware) {
            if (!$middleware::process()) {
                return false;
            }
        }

        return true;
    }
}