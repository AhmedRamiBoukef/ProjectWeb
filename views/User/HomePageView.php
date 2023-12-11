<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
class HomePageView extends LayoutView
{
    public function showDiaporama() {
        ?>
        <div id="carouselAuto" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="/Project/public/images/car1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/Project/public/images/car2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/Project/public/images/car3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselAuto" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselAuto" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
<?php
    }

    public function showBrands() {
        ?>
            <div class="Brands">
                <h1>Brands</h1>
                <div class="marquee">
                    <ul class="marquee-content">
                    <?php
                        $controller = new AdminBrandsPageController();
                        $brands = $controller->getBrands();
                        foreach ($brands as $brand) {
                            ?>
                                <li><a href="/Project/Brand/<?php echo $brand['BrandID'] ?>"><img src="/Project/public/images/<?php echo $brand['ImagePath'] ?>" alt="" srcset=""></a></li>
                            <?php
                        }
                    ?>
                        
                    </ul>
                </div>
            </div>
        <?php
    }
    public function showComprare() {
        ?>
            <div class="Brands">
                <img src="" alt="">
                <h1>Brands</h1>
                <div class="marquee">
                    <ul class="marquee-content">
                    <?php
                        $controller = new AdminBrandsPageController();
                        $brands = $controller->getBrands();
                        foreach ($brands as $brand) {
                            ?>
                                <li><a href="/Project/Brand/<?php echo $brand['BrandID'] ?>"><img src="/Project/public/images/<?php echo $brand['ImagePath'] ?>" alt="" srcset=""></a></li>
                            <?php
                        }
                    ?>
                        
                    </ul>
                </div>
            </div>
        <?php
    }
    
    public function showHomePage()
    {
        $this->showHeader();
        $this->showDiaporama();
        $this->showMenu();
        $this->showBrands();
        $this->showFooter();
    }
}