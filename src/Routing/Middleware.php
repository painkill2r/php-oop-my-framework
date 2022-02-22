<?php

namespace Painkill2r\InflearnLectureLib\Routing;

/**
 * 미들웨어 추상 클래스의 구현체를 선언하여
 * 라우트 실행 전 먼저 실행되는 기능을 정의 할 수 있음.
 */
abstract class Middleware
{
    /**
     * 라우트 실행 전 먼저 실행되는 기능을 정의하는 메소드
     * 실행 중 에러가 발생하거나, 'false'를 반환하면 라우트는 실행되지 않음.
     * 예) 로그인 여부 확인 로직을 구현하여 만약, 로그인을 하지 않았다면 로그인 페이지로 이동시킨다.
     *
     * @return mixed
     */
    abstract public static function process();
}