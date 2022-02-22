<?php

namespace Painkill2r\InflearnLectureLib\Session;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

/**
 * 데이터베이스 기반 세션 핸들러
 */
class DatabaseSessionHandler implements \SessionHandlerInterface
{

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
     * @return false|string
     */
    public function read($id)
    {
        $data = current(Adaptor::getAll("SELECT * FROM sessions WHERE id = ?", [$id]));

        if ($data) {
            $payload = $data->payload;
        } else {
            Adaptor::exec("INSERT INTO sessions(id) VALUES(?)", [$id]);
        }

        return $payload ?? '';
    }

    /**
     * 세션에 데이터 쓰기
     *
     * @param string $id 세션 ID
     * @param resource $payload 세션에 저장할 데이터
     * @return bool|void
     */
    public function write($id, $payload)
    {
        return Adaptor::exec("UPDATE sessions SET payload = ? WHERE id = ?", [$payload, $id]);
    }

    /**
     * 세션 삭제
     *
     * @param string $id 세션 ID
     * @return bool|void
     */
    public function destroy($id)
    {
        return Adaptor::exec("DELETE FROM sessions WHERE id = ?", [$id]);
    }

    /**
     * 만료된 세션 제거
     *
     * @param $maxLifeTime 세션 유효 기간
     * @return bool
     */
    public function gc($maxLifeTime)
    {
        if ($sessions = Adaptor::getAll("SELECT * FROM sessions")) {
            foreach ($sessions as $session) {
                $timestamp = strtotime($session->created_at);

                if (time() - $timestamp > $maxLifeTime) {
                    $this->destroy($session->id);
                }
            }

            return true;
        }

        return false;
    }
}
