<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/views/LoginPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/Models/LoginModel.php');
class LoginPageController
{
    public function handleLogin()
    {
        $username = $_POST['admin_username'];
        $password = $_POST['admin_password'];
        $login = new LoginModel();
        $user = $login->login($username,$password);
        if ($user) {
            session_start();
            $_SESSION['admin'] = true;
            header('Location: /Project/Admin/home/');
            exit();
        } else {
            header('Location: /Project/Admin/login/?error=1');
        }
    }
    public function handleLogout()
    {
        session_start();
        if (isset($_SESSION['admin'])) {
            session_destroy();
        }
        header('Location: /Project/Admin/login/');
    }
    public function showLoginPage($error)
    {
        $view = new LoginPageView();
        $view->showLoginPage($error);
    }
}