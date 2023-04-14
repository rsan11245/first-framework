<?php

namespace application\controllers;

use application\core\Controller;


class MainController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->getNews();

        $this->view->render('Главная страница', ['news' => $result]);
    }

}