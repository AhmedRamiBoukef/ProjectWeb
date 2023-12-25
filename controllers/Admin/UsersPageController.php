<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/UsersPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/UserModel.php');


class AdminUsersPageController
{
    
    public function getUsers()
    {
        $model = new UserModel();
        return $model->getUsers();
    }
    public function showUsersPage()
    {
        $view = new AdminUsersPageView();
        $view->showUsersPage();
    }

}