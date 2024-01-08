<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/LayoutView.php');
class AdminBrandPageView extends AdminLayoutView
{
    public function content()
    {
?>
        <div class="container">
            <div id="filter">
                <h4>Select data to filter</h4>
                <div>
                    <select class="form-control bootstrap-table-filter-control-model">
                        <option value="">Model</option>
                    </select>
                    <select class="form-control bootstrap-table-filter-control-version">
                        <option value="">Version</option>
                    </select>
                    <select class="form-control bootstrap-table-filter-control-year">
                        <option value="">Year</option>
                    </select>
                </div>
            </div>

            <table id="table" data-filter-control-container="#filter" data-toggle="table" data-searchable="true" data-search="true" data-filter-control="true" class="table-responsive">
            <thead>
                <tr>
                
                <th data-field="brand" data-filter-control="select" data-sortable="true">Brand</th>
                <th data-field="model" data-filter-control="select" data-sortable="true">Model</th>
                <th data-field="version" data-filter-control="select" data-sortable="true">Version</th>
                <th data-field="year" data-filter-control="select" data-sortable="true">Year</th>
                <th>Link</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
                    $controller = new AdminBrandsPageController();
                    $brands = $controller->getBrands();
                    
                    foreach ($brands as $brand) {
                ?>
                <tr>
                    <td><?php echo $brand['Brand'] ?></td>
                    <td><?php echo $brand['Model'] ?></td>
                    <td><?php echo $brand['Version'] ?></td>
                    <td><?php echo $brand['Year'] ?></td>
                    <td><a href="/Project/Admin/vehicule/?AdminVehiculeid=<?php echo $brand['VehicleID'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">  <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>  <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/></svg></a></td>
                </tr>
                <?php
                    }
                ?>
                
            </tbody>
            </table>
        
        </div>
        
<?php
    }
    public function showBrandsPage()
    {
        $this->showNavbar();
        $this->content();
    }


}