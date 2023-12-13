<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
class ComparePageView extends LayoutView
{

    public function showComparePage()
    {
        $this->showHeader();
        $this->showMenu();
        $this->showComprare();
        $this->showFooter();
    }
}
