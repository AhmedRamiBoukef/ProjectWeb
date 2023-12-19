<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/User/ComparePageController.php');
class ComparePageView extends LayoutView
{
    public function showComprareTable($vehicleIDs)
    {
        $controller = new ComparePageController();
        $vehicles = [];
        foreach ($vehicleIDs as $vehicleID) {
            $vehicle = $controller->getCompare($vehicleID);
            $vehicles[] = $vehicle;
        }
        ?>
        <div class="compare-table">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php foreach ($vehicles as $vehicle) { ?>
                            <th><?= $vehicle['VehiculeName'] ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $attributes = [
                        'BrandName', 'ModelName', 'ModelYear', 'Version', 'Note',
                        'Power', 'Consumption', 'Dimensions', 'Capacity','Acceleration','TopSpeed','VitesseTYPE', 'IndicativePrice'
                    ];
                    ?>
                    <tr>
                        <?php foreach ($vehicles as $vehicle) { ?>
                            <td><a href="/Project/vehicule?VehiculeID=<?php echo$vehicle['VehicleID'] ?>" alt="<?php echo$vehicle['VehicleID'] ?>"><img src="/Project/public/images/<?php echo$vehicle['ImagePath'] ?>" alt="<?php echo$vehicle['ImagePath'] ?>"></a></td>
                        <?php } ?>
                    </tr>
                    <?php
    
                    foreach ($attributes as $attribute) { ?>
                        <tr class="compare-attr">
                            <?php foreach ($vehicles as $vehicle) { ?>
                                <td>
                                    <div><?= $vehicle[$attribute] ?></div>
                                    <div><?= $attribute ?></div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php

    }

    public function showComparePage($vehicleIDs)
    {
        $this->showHeader();
        $this->showMenu();
        $this->showComprare();
        $this->showComprareTable($vehicleIDs);
        $this->showFooter();
    }
}
