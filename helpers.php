<?php

if (!function_exists('app')) {
    function app(): \App\App
    {
        return \App\App::instance();
    }
}

if (!function_exists('csrf')) {
    function csrf(): string
    {
        $csrf = app()->csrf;
        return <<<"HTML"
        <input type="hidden" name="_token" value="$csrf">
        HTML;
    }
}

if (!function_exists('view')) {
    function view(string $name, array $data = []): string
    {
        return app()->engine->render(str_replace('.', DIRECTORY_SEPARATOR, $name), $data);
    }
}

if (!function_exists('flash')) {
    function flash(?string $message = null, ?string $type = 'error')
    {
        if (!isset($_SESSION['msg'])) {
            $_SESSION['msg'] = [];
        }

        $_SESSION['msg'][] = [$type, $message];
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}
