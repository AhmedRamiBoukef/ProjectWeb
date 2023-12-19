<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
class HomePageView extends LayoutView
{
    

    public function showBrands()
    {
    ?>
        <div class="Brands">
            <h1>Brands</h1>
            <div class="spinner">
                <ul class="spinner-content">
                    <?php
                    $controller = new AdminBrandsPageController();
                    $brands = $controller->getBrands();
                    foreach ($brands as $brand) {
                    ?>
                        <li><a href="/Project/Brand/<?php echo $brand['BrandID'] ?>"><img src="/Project/public/images/<?php echo $brand['ImagePath'] ?>" alt="Brand<?php echo $brand['BrandID'] ?>"></a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    <?php
    }
    

    public function showPopular()
    {
    ?>
        <div class="popular">
            <h1>Popular car comparisons</h1>
            <p>Here’s how the most-searched-for-vehiculs on the road differ.</p>
            <div>
                <?php
                $controller = new HomePageController();
                $controller->getComparaison();
                foreach ($controller->getComparaison() as $comparaison) {
                    $this->showVehicleCard($comparaison);
                }

                ?>
            </div>

        </div>
<?php
    }

    public function showGuide() {
        ?>
        <div class="guide-section">
            <div>
                <h2>To assist you in your decision,</h2>
                <h2>discover our</h2>
                <h2>buying guides.</h2>
                <a href="/Project/guide/">See all our guides.</a>
            </div>
            <div>
                <img src="/Project/public/images/guide_photo.png" alt="guide_photo">
            </div>
        </div>
        <?php
    }

    public function showHomePage()
    {
        $this->showHeader();
        $controller = new HomePageController();
        $diaporama = $controller->getDiaporama();
        $this->showDiaporama($diaporama);
        $this->showMenu();
        $this->showBrands();
        $this->showComprare();
        $this->showGuide();
        $this->showPopular();
        $this->showFooter();
    }
}
