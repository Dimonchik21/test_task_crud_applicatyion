<?php

namespace App\Controllers;

use App\Core\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        $data = $this->model->getMenu();

        $result = $this->prepareArrayForMenu($data);

        $vars = [
            'menu' => $result,
        ];

        $this->view->render('Страница пока меню', $vars);
    }

    private function prepareArrayForMenu($data)
    {
        $result = [];

        foreach ($data as $value) {
            if ($value['parent'] != 0) {
                $result[$value['parent']]['child'][] = $value;
                continue;
            }

            $result[$value['id']] = $value;
            $result[$value['id']]['child'] = [];
        }

        return $result;
    }

    public function dashboardAction()
    {
        $data = $this->model->getMenu();

        $vars = [
            'menu' => $data,
        ];
        $this->view->render('Главная страница для модерации меню', $vars);
    }
}
