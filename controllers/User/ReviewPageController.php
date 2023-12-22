<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/NewsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/NewsDetailsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/ReviewModel.php');


class ReviewPageController
{
    public function getPopularReviews($id) {
        $model = new ReviewModel();
        return $model->getPopularReviews($id);
    }
    public function postReview($data) {
        $model = new ReviewModel();
        return $model->getPopularReviews($data);
    }
}