<?php

namespace Painkill2r\InflearnLectureLib\Session;

/**
 * 파일 기반 세션 핸들러
 */
class FileSessionHanlder implements \SessionHandlerInterface
{
    /**
     * @var string $path 세션 저장 경로
     */
    protected $path = './sessions';

    /**
     * @param string $savePath 세션 저장 경로
     * @param string $sessionName 세션 이름
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * 새로운 세션이 들어오거나 이미 있는 세션을 조회
     *
     * @param string $id 세션 ID(세션이 없을 때 내부적으로 자동 생성됩니다. 만약, PHPSESSID 가 존재하는 경우 그 값으로 대체합니다.)
     * @return string
     */
    public function read($id)
    {
        //새로운 세션일 때는 파일이 존재하지 않습니다. 그래서 에러를 유발하지만 @ 연산자로 무시합니다.
        //이 경우에는 생성을 SessionHandlerInterface::write() 에서 합니다.
        return (string)@file_get_contents($this->path . '/' . $id);
    }

    /**
     * 세션에 데이터 쓰기
     *
     * @param string $id 세션 ID
     * @param resource $payload 세션에 저장할 데이터
     * @return bool
     */
    public function write($id, $payload)
    {
        //file_put_contests 는 파일이 존재하지 않을 경우 생성합니다. 만약, 존재하는 경우 덮어씁니다.
        return file_put_contents($this->path . '/' . $id, $payload) === false ? false : true;
    }

    /**
     * 세션 삭제
     *
     * @param string $id 세션 ID
     * @return bool
     */
    public function destroy($id)
    {
        return true;
    }

    /**
     * 만료된 세션 제거
     *
     * @param $maxlifetime 세션 유효기간
     * @return bool
     */
    public function gc($maxLifeTime)
    {
        return true;
    }
}
