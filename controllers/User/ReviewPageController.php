<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/NewsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/ReviewDetailsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/ReviewModel.php');


class ReviewPageController
{
    public function getPopularReviews($id) {
        $model = new ReviewModel();
        return $model->getPopularReviews($id);
    }
    public function getVehicleReviews($id, $page = 1) {
        $model = new ReviewModel();
        $view = new ReviewPageView();
        $view->showReviewList($model->getVehicleReviews($id, $page));
    }
    public function getNombreReviewsByID($id) {
        $model = new ReviewModel();
        return $model->getNombreReviewsByID($id);
    }
    public function postReview($data) {
        $model = new ReviewModel();
        return $model->getPopularReviews($data);
    }
    public function showReviewPage($id)
    {
        $view = new ReviewPageView();
        $view->showReviewPage($id);
    }
}