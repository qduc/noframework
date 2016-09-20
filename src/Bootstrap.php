<?php
/**
 * Created by PhpStorm.
 * User: quang_duc
 * Date: 9/20/2016
 * Time: 3:54 PM
 */
namespace Example;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development';
//$environment = 'production';

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Ops! Something went wrong.';
    });
}
$whoops->register();

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse();

foreach ($response->getHeaders() as $header) {
    $header($header, false);
}

echo $response->getContent();