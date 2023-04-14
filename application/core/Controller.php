<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($this->route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;

        }
    }

    public function checkAcl()
    {
        $acl = require 'application/acl/' . $this->route['controller'] . '.php';
        $this->acl = $acl;
        if ($this->isAcl('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
            return true;
        }
        return false;
    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}