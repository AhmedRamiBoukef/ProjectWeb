<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');

class BrandsPageView extends LayoutView
{
    
    public function showBrand()
    {
        ?>
        <div >
        </div>
        <?php
        
    }

    public function showBrandsPage()
    {
        $this->showHeader();
        $this->showMenu();
        $this->showBrands();
        $this->showBrand();
        $this->showFooter();
    }
}
