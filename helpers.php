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

if (!function_exists('cache')) {
    function cache($filename, callable $fn, int $expires = 1800, bool $force = false, ?callable $retrieved = null)
    {
        $filename = trim($filename, DIRECTORY_SEPARATOR);

        $path = explode('/', $filename);
        array_pop($path);
        $path = implode('/', $path);

        $cachePath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'himmlisch-school';

        $folderPath = $cachePath . DIRECTORY_SEPARATOR . $path;
        $filePath = $cachePath . DIRECTORY_SEPARATOR . $filename;

        $expires = time() + $expires;

        $save = function () use ($fn, $filePath, $expires) {
            $return = $fn();
            if ($return) {
                file_put_contents($filePath, "$expires\n$return");
            }
            return $return;
        };

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);

            return $save();
        }

        if (!$force && is_file($filePath)) {
            $content = file_get_contents($filePath);
            $shouldExpire = (int) strtok($content, "\n");

            if (time() < $shouldExpire) {
                $content = substr($content, strpos($content, "\n") + 1);
                if (!is_null($retrieved)) {
                    $retrieved($shouldExpire);
                }
                return $content;
            }
        }

        return $save();
    }
}
