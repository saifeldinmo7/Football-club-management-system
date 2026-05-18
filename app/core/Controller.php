<?php

require_once __DIR__ . '/../../config/config.php';

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die('View not found: ' . $view);
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect(BASE_URL . 'index.php?page=login');
        }
    }
}