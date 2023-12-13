<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/ReviewPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/ReviewModel.php');

class AdminReviewPageController
{
    public function getReviews()
    {
        $model = new ReviewModel();
        return $model->getReviews();
    }
    
    public function showReviewPage()
    {
        $view = new AdminReviewPageView();
        $view->showReviewPage();
    }

}