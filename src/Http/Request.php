<?php

namespace Painkill2r\InflearnLectureLib\Http;

/**
 * 요청에 관련된 처리
 */
class Request
{
    /**
     * 요청 Method 반환 메소드
     *
     * @return mixed
     */
    public static function getMethod()
    {
        return filter_input(INPUT_POST, "_method") ?: $_SERVER['REQUEST_METHOD'];
    }

    /**
     * 요청 URL 반환 메소드
     *
     * @return mixed|string
     */
    public static function getPath()
    {
        return $_SERVER['PATH_INFO'] ?? "/";
    }
}
