<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');
class HomePageView extends LayoutView
{
    public function showDiaporama()
    {
?>
        <div id="carouselAuto" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ">
                <?php

                $controller = new HomePageController();
                $diaporama = $controller->getDiaporama();
                $i=0;
                foreach ($diaporama as $slide) {
                    if($i==0){
                        ?>
                        <a href="<?php echo $slide['SlideshowLinkURL'] ?>" class="carousel-item active" data-bs-interval="5000">
                            <img src="/Project/public/images/<?php echo $slide['SlideshowImagePath'] ?>" class="d-block w-100" alt="<?php echo $slide['SlideshowImagePath'] ?>">
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="<?php echo $slide['SlideshowLinkURL'] ?>" class="carousel-item" data-bs-interval="5000">
                            <img src="/Project/public/images/<?php echo $slide['SlideshowImagePath'] ?>" class="d-block w-100" alt="<?php echo $slide['SlideshowImagePath'] ?>">
                        </a>
                        <?php
                    }
                    $i = $i+1;
                }
                ?>
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

    public function showBrands()
    {
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
        $this->showDiaporama();
        $this->showMenu();
        $this->showBrands();
        $this->showComprare();
        $this->showGuide();
        $this->showPopular();
        $this->showFooter();
    }
}
