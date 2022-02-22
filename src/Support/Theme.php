<?php

namespace Painkill2r\InflearnLectureLib\Support;

/**
 * 사용자 View에 관련된 처리
 */
class Theme
{
    private static $layout;

    /**
     * 레이아웃 설정 메소드
     *
     * @param string $layout 레이아웃 경로
     * @return void
     */
    public static function setLayout($layout)
    {
        self::$layout = $layout;
    }

    /**
     * View 설정 메소드
     *
     * @param string $view View 이름
     * @param array $vars View에 전달할 데이터 배열
     * @return mixed
     */
    public static function view($view, $vars = [])
    {
        foreach ($vars as $name => $value) {
            $$name = $value;
        }

        return require_once self::$layout;
    }
}