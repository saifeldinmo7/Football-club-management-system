<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../factories/UserFactory.php';
require_once __DIR__ . '/../../config/config.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->userModel = new User();
    }

    public function showLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect(BASE_URL . 'index.php?page=dashboard');
        }

        $this->view('auth/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=login');
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = trim($_POST['role'] ?? '');

        if ($username === '' || $password === '' || $role === '') {
            $this->view('auth/login', [
                'error' => 'Please fill in all fields.'
            ]);
            return;
        }

        $user = $this->userModel->findByUsernameAndRole($username, $role);

        if (!$user || $password !== $user['password']) {
            $this->view('auth/login', [
                'error' => 'Invalid username, password, or role.'
            ]);
            return;
        }

        $roleObject = UserFactory::createUser($user['role']);

        if ($roleObject === null) {
            $this->view('auth/login', [
                'error' => 'Invalid user role.'
            ]);
            return;
        }

        $_SESSION['user_id'] = $user['userId'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['dashboard_title'] = $roleObject->getDashboardTitle();
        $_SESSION['allowed_pages'] = $roleObject->getAllowedPages();

        $this->redirect(BASE_URL . 'index.php?page=dashboard');
    }

    public function dashboard()
    {
        $this->requireLogin();

        $this->view('dashboard/index');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->redirect(BASE_URL . 'index.php?page=login');
    }
}