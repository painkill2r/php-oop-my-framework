<?php

namespace Painkill2r\InflearnLectureLib\Support;

/**
 * "부트스트래핑"의 핵심으로 프레임워크의 패키지 또는 익스텐션을 등록해주는 역할
 * 예) 이벤트 리스너, 미들웨어, 라우트 등을 등록
 * 추상 클래스이므로 이를 확장한 프로바이더를 구현하여 사용해야 한다.
 */
abstract class ServiceProvider
{
    /**
     * 프로바이더에서 등록할 기능들을 선언하는 메소드
     *
     * @return void
     */
    public static function register()
    {

    }

    /**
     * 프로바이더 실행할 기능들을 선언하는 메소드
     *
     * @return void
     */
    public static function boot()
    {

    }
}
