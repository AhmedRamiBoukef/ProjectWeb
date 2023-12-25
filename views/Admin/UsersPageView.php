<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/LayoutView.php');
class AdminUsersPageView extends AdminLayoutView
{
    public function content()
    {
?>
        <div class="container">
            <div id="filter">
                <h4>Select data to filter</h4>
                <div>
                    <select class="form-control bootstrap-table-filter-control-Gender">
                        <option value="">Gender</option>
                    </select>
                    <select class="form-control bootstrap-table-filter-control-Status">
                        <option value="">Status</option>
                    </select>
                </div>
            </div>

            <table id="table" data-filter-control-container="#filter" data-toggle="table" data-searchable="true" data-search="true" data-filter-control="true" class="table-responsive">
            <thead>
                <tr>
                    <th data-field="Username" data-sortable="true">Username</th>
                    <th data-field="FirstName" data-sortable="true">First Name</th>
                    <th data-field="LastName" data-sortable="true">Last Name</th>
                    <th data-field="Gender" data-filter-control="select"  data-sortable="true">Gender</th>
                    <th data-field="DateOfBirth" data-sortable="true">Date Of Birth</th>
                    <th data-field="Email" data-sortable="true">Email</th>
                    <th data-field="Status" data-filter-control="select"  data-sortable="true">Status</th>
                    <th data-field="Modify"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/UsersPageController.php');
                    $controller = new AdminUsersPageController();
                    $users = $controller->getUsers();
                    
                    foreach ($users as $user) {
                ?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['FirstName'] ?></td>
                        <td><?= $user['LastName'] ?></td>
                        <td><?= $user['Gender'] ?></td>
                        <td><?= $user['DateOfBirth'] ?></td>
                        <td><?= $user['Email'] ?></td>
                        <td><?= $user['IsBlocked'] ? "Blocked" : "Not Blocked" ?></td>
                        <td><a href="/Project/Admin/users/?id=<?= $user['UserID'] ?>"><svg xm?id=lns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg></a></td>
                    </tr>
                <?php
                    }
                ?>
                
            </tbody>
            </table>
        
        </div>
        
<?php
    }
    public function showUsersPage()
    {
        $this->showNavbar();
        $this->content();
    }


}