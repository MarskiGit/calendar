<?php

declare(strict_types=1);
require_once("src/utils/debug.php");
require_once('config/config.php');
spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

use App\controller\AppController;
use App\view\Request;
use App\view\View;
use App\exception\AppException;

try {
    $request = [
        'get' => $_GET,
        'post' => $_POST,
        'server' => $_SERVER
    ];

    $Request = new Request($request);
    $View = new View();

    (new AppController($Request, $View));
} catch (AppException $e) {
    echo "<div class='exception align_center'><p>Błąd Aplikacji</p><p>" . $e->getMessage() . "</p><div class='exception_img'></div></div>";
} catch (\Throwable $e) {
    echo "<div class='exception align_center'><p>Krytyczny Błąd Aplikacji</p><p>" . $e->getMessage() . "</p><div class='exception_img'></div></div>";
    dump($e);
}
