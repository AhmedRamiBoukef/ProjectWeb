<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/ComparePageView.php');
class ComparePageController
{
    public function showComparePage()
    {
        $view = new ComparePageView();
        $view->showComparePage();
    }
}