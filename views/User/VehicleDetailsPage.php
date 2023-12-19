<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/User/NewsPageController.php');

class VehicleDetailsPageView extends LayoutView
{

    
    public function showVehicleDetails($id)
{
    $controller = new VehiclePageController();
    $vehicle = $controller->getVehicleByID($id);

    ?>
    <div>
        
    </div>
    <?php
}

    public function showVehicleDetailsPage($id)
    {
        $this->showHeader();
        $this->showMenu();
        $this->showVehicleDetails($id);
        $this->showFooter();
    }
    
}

?>