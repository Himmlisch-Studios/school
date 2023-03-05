<?php

namespace App;

use Exception;

class App
{
    protected static self $instance;

    public string $uri;
    public string $csrf;
    public string $method;
    public \Foil\Engine $engine;

    public function __construct(
        public string $root
    ) {
        static::$instance = $this;
    }

    public function init(): void
    {
        session_start() ?? throw new Exception('Session handler couldn\'t load');
        $this->initSecurity();
        $this->initRequest();
        $this->initEngine();
    }

    public static function instance(): static
    {
        if (!isset(static::$instance)) {
            throw new Exception("Server not initialized", 1);
        }
        return static::$instance;
    }

    protected function initSecurity()
    {
        header("X-XSS-Protection: 1; mode=block");
        // header("content-security-policy: default-src 'self'; img-src https://*; child-src 'none';");
        session_regenerate_id(true);
    }

    protected function initRequest()
    {
        $this->uri = '/' . trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);

        if ($this->method == 'POST') {
            $token = htmlspecialchars($_POST['_token']);
            if (!$token || $token !== $_SESSION['token']) {
                return;
            }
        }

        $this->csrf = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    protected function initEngine()
    {
        $foil = \Foil\Foil::boot([
            'folders' => ["{$this->root}/views"]
        ]);
        $this->engine = $foil->engine();
    }
}
