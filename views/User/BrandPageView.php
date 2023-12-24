<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');

class BrandPageView extends LayoutView
{
    
    public function showBrand($id)
    {
        ?>
        <div >
        </div>
        <?php
        
    }

    public function showBrandPage($id)
    {
        $this->showHeader();
        $this->showMenu();
        $this->showBrand($id);
        $this->showFooter();
    }
}
