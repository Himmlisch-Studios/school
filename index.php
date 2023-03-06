<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new App\App(__DIR__);
$app->init();

$action = match ($app->uri) {
    '/' => 'HomeController',
    '/apa' => 'ApaController@form',
    '/apa/submit' => 'ApaController@action',
    '/apa/result' => 'ApaController@result',
    default => 'ErrorController@code404'
};

$action = explode('@', $action);

try {
    if (!isset($app->csrf)) {
        throw new Exception('Expired page. Please reload');
    }

    $class = "App\\Controllers\\{$action[0]}";
    $body = call_user_func_array(count($action) > 1 ? [new $class, $action[1]] : new $class, []);
} catch (\Throwable $th) {
    http_response_code(500);
    $body = (new \App\Controllers\ErrorController())->code500($th->getMessage());
}

$app->setBody($body)
    ->show();
