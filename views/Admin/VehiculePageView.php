<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/LayoutView.php');
class AdminVehiculePageView extends AdminLayoutView
{
    public function content($AdminVehiculeid)
    {
?>
        <div class="container">

            <table id="table" data-toggle="table" data-searchable="true" data-search="true" data-filter-control="true" class="table-responsive">
            <thead>
                <tr>
                    <th data-field="vehicule" data-filter-control="select" data-sortable="true">Vehicule Name</th>
                    <th data-field="image">Image</th>
                    <th data-field="note" data-filter-control="select" data-sortable="true">Note</th>
                    <th data-field="price" data-filter-control="select" data-sortable="true">Price</th>
                    <th data-field="dimention" data-filter-control="select" data-sortable="true">Dimensions</th>
                    <th data-field="capacity" data-filter-control="select" data-sortable="true">Capacity</th>
                    <th data-field="consumption" data-filter-control="select" data-sortable="true">Consumption</th>
                    <th data-field="type" data-filter-control="select" data-sortable="true">VitesseTYPE</th>
                    <th data-field="engine" data-filter-control="select" data-sortable="true">EngineName</th>
                    <th data-field="enginetype" data-filter-control="select" data-sortable="true">EngineType</th>
                    <th data-field="power" data-filter-control="select" data-sortable="true">Power</th>
                    <th data-field="adceleration" data-filter-control="select" data-sortable="true">Acceleration</th>
                    <th data-field="topspeed" data-filter-control="select" data-sortable="true">TopSpeed</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
                    $controller = new AdminBrandsPageController();
                    $infos = $controller->getVehiculeInfo($AdminVehiculeid);
                    
                    foreach ($infos as $info) {
                ?>
                <tr>
                <tr>
                    <td><?php echo $info['VehiculeName'] ?></td>
                    <td><?php echo $info['ImageID'] ?></td>
                    <td><?php echo $info['Note'] ?></td>
                    <td><?php echo $info['IndicativePrice'] ?></td>
                    <td><?php echo $info['Capacity'] ?></td>
                    <td><?php echo $info['Consumption'] ?></td>
                    <td><?php echo $info['VitesseTYPE'] ?></td>
                    <td><?php echo $info['EngineName'] ?></td>
                    <td><?php echo $info['EngineType'] ?></td>
                    <td><?php echo $info['Power'] ?></td>
                    <td><?php echo $info['Acceleration'] ?></td>
                    <td><?php echo $info['TopSpeed'] ?></td>
                </tr>
                </tr>
                <?php
                    }
                ?>
                
            </tbody>
            </table>
        
        </div>
        
<?php
    }
    public function showVehiculePage($AdminVehiculeid)
    {
        $this->showNavbar();
        $this->content($AdminVehiculeid);
    }


}