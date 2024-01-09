<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/GuidePageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/NewsDetailsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/NewsModel.php');


class GuidePageController
{
    public function getNews($offset, $limit)
    {
        $model = new NewsModel();
        return $model->getNews($offset, $limit);
    }
    public function showGuidePage()
    {
        $view = new GuidePageView();
        $view->showGuidePage();
    }
    public function showNewsDetailsPage($id)
    {
        $view = new NewsDetailsPageView();
        $view->showNewsDetailsPage($id);
    }
}