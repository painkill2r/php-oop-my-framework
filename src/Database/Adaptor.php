<?php

namespace Painkill2r\InflearnLectureLib\Database;

/**
 * 데이터베이스에 관련된 처리
 */
class Adaptor
{
    /**
     * @var object $pdo PDO 객체
     */
    private static $pdo;

    /**
     * @var object $sth PDOStatement 객체
     */
    private static $sth;

    /**
     * 데이터베이스 연결 메소드
     *
     * @param string $dsn 데이터 소스 이름
     * @param string $username 데이터베이스 사용자
     * @param string $password 데이터베이스 사용자 비밀번호
     * @return void
     */
    public static function setup($dsn, $username, $password)
    {
        self::$pdo = new \PDO($dsn, $username, $password);
    }

    /**
     * SQL 명령문 실행 메소드
     *
     * @param string $query SQL 명령문
     * @param array $params SQL 명령문 '?' 변수에 바인딩될 값의 배열
     * @return void
     */
    public static function exec($query, $params = [])
    {
        if (self::$sth = self::$pdo->prepare($query)) {
            return self::$sth->execute($params);
        }
    }

    /**
     * SQL 명령문 실행 후 배열을 반환하는 메소드
     *
     * @param string $query SQL 명령문
     * @param array $param SQL 명령문 '?' 변수에 바인딩될 값의 배열
     * @param string $classname 지정된 클래스의 인스턴스를 반환하도록 설정
     * @return void
     */
    public static function getAll($query, $param = [], $classname = "stdClass")
    {
        if (self::exec($query, $param)) {
            return self::$sth->fetchAll(\PDO::FETCH_CLASS, $classname);
        }
    }
}
