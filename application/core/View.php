<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $this->route['controller'] . '/' . $this->route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        if (file_exists('application/views/' . $this->path . '.php')) {
            ob_start();
            require 'application/views/' . $this->path . '.php';
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Страница не найдена';
        }
    }

    public function redirect($url) {
        header('Location: ' .$url);
        exit;
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        require 'application/views/errors/' . $code . '.php';
        exit;
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }
}