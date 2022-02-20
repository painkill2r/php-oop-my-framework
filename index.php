<?php

require_once "./vendor/autoload.php";

use Painkill2r\InflearnLectureLib\Database\Adaptor;
use Painkill2r\InflearnLectureLib\Http\Request;
use Painkill2r\InflearnLectureLib\Routing\Route;
use Painkill2r\InflearnLectureLib\Routing\RequestContext;
use Painkill2r\InflearnLectureLib\Routing\Middleware;
use Painkill2r\InflearnLectureLib\Session\DatabaseSessionHandler;
use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Support\Theme;
use Painkill2r\InflearnLectureLib\Application;

class HelloMiddleware extends Middleware
{
    public static function process()
    {
        //return false;
        return true;
    }
}

//데이터베이스 연결
class AdaptorServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Adaptor::setup("mysql:host=58.151.141.250;port=3306;dbname=oopproject", "oopproject", "oopproject123~");
    }
}

//세션을 켜는 일
class SessionServiceProvider extends ServiceProvider
{
    public static function register()
    {
        session_set_save_handler(new DatabaseSessionHandler());
    }

    public static function boot()
    {
        session_start();
    }
}

//라우팅 설정하기
class RouteServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Route::add("get", "/", function () {
            echo "Hello, World!";
        }, [HelloMiddleware::class]);

        Route::add("get", "/posts/{id}", function ($id) {
            if ($post = Adaptor::getAll("SELECT * FROM posts WHERE id = ?", [$id])) {
                return var_dump($post);
            }

            http_response_code(404);
        });
    }

    public static function boot()
    {
        Route::run();
    }
}

$app = new Application([
    AdaptorServiceProvider::class,
    SessionServiceProvider::class,
    RouteServiceProvider::class
]);

$app->boot();

$_SESSION['message'] = "Hello, World!";
$_SESSION['foo'] = new stdClass();