<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/LayoutView.php');
class AdminReviewPageView extends AdminLayoutView
{
    public function content()
    {
?>
        <div class="container">

            <table id="table" data-toggle="table" data-searchable="true" data-search="true" data-filter-control="true" class="table-responsive">
            <thead>
                <tr>
                
                <th data-field="user" data-filter-control="select" data-sortable="true">User</th>
                <th data-field="vehicule" data-filter-control="select" data-sortable="true">Vehicule</th>
                <th data-field="version" data-filter-control="select" data-sortable="true">Comment</th>
                <th data-field="rating" data-filter-control="select" data-sortable="true">Rating</th>
                <th data-field="status" data-filter-control="select" data-sortable="true">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/ReviewPageController.php');
                    $controller = new AdminReviewPageController();
                    $reviews = $controller->getReviews();
                    
                    foreach ($reviews as $review) {
                ?>
                <tr>
                    <td><?php echo $review['username'] ?></td>
                    <td><?php echo $review['VehiculeName'] ?></td>
                    <td><?php echo $review['Comment'] ?></td>
                    <td><?php echo $review['Rating'] ?></td>
                    <td><?php echo $review['Status'] ?></td>
                </tr>
                <?php
                    }
                ?>
                
            </tbody>
            </table>
        
        </div>
        
<?php
    }
    public function showReviewPage()
    {
        $this->showNavbar();
        $this->content();
    }


}