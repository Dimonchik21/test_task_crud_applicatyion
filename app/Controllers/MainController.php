<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->getMenu();

        $vars = [
            'menu' => $result,
        ];

        $this->view->render('Главная страница', $vars);
    }
}
