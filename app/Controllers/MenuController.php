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

    public function listAction()
    {
        $data = $this->model->getMenu();

        $vars = [
            'menu' => $data,
        ];

        $this->view->render('Главная страница для модерации меню', $vars);
    }

    public function addAction()
    {
        $post = $_POST;

        $vars = [
            'new_item_menu' => $post,
        ];

        $this->view->render('Добавить элемент в меню', $vars);
    }

    public function deleteAction()
    {
        $data = $this->model->getMenu();

        $vars = [
//            'id_item_menu' => $id,
            'menu' => $data,
        ];

        if (isset($_POST['id'])) {
            $errors = $this->delete($_POST['id']);
            $vars['id_item_menu'] = $_POST['id'];
            $vars['errors'] = $errors;
        }

        $this->view->render('Удалить элемент в меню', $vars);
    }

    private function delete($id)
    {
        $menuArray = $this->model->getMenu();
//        var_dump($menuArray);

        foreach ($menuArray as $key => $item) {
            if ($item['id'] == $id) {
                unset($menuArray[$key]);
            }
        }

        return $this->model->save($menuArray);
    }
}
