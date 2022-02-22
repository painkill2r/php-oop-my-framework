<?php

namespace Painkill2r\InflearnLectureLib;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;

/**
 * 애플리케이션을 실행하는 역할(부트스트래핑)
 */
class Application
{
    /**
     * @var array $providers 프로바이더 목록
     */
    private $providers = [];

    /**
     * Application 생성자 메소드
     * 등록된 프로바이더가 있으면 각 인스턴스별 register() 메소드를 실행시킨다.
     *
     * @param array $providers 프로바이더 목록
     */
    public function __construct($providers = [])
    {
        $this->providers = $providers;

        array_walk($this->providers, fn($provider) => $provider::register());
    }

    /**
     * 실행 메소드
     * 등록된 프로바이더가 있으면 각 인스턴스별 boot() 메소드를 실행시킨다.
     *
     * @return void
     */
    public function boot()
    {
        array_walk($this->providers, fn($provider) => $provider::boot());
    }
}
