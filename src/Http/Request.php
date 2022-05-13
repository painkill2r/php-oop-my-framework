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
     * Apache 웹 서버를 사용하는 경우 만약, $_SERVER 배열에 'PATH_INFO'가 없으면
     * 이를 'REQUEST_URI'를 통해 처리
     *
     * @return mixed|string
     */
    public static function getPath()
    {
        if (array_key_exists("PATH_INFO", $_SERVER)) {
            return $_SERVER['PATH_INFO'] ?? "/";
        } else {
            return explode("?", $_SERVER['REQUEST_URI'])[0];
        }
    }
}
