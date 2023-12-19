<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');


class LayoutView
{
    public function showMenu()
    {
?> <nav class="menu">
        <ul>
            <li><a href="/Project/">Home</a></li>
            <li><a href="/Project/news/">News</a></li>
            <li><a href="/Project/compare/">Comparator</a></li>
            <li><a href="/Project/brands/">Brands</a></li>
            <li><a href="/Project/reviews/">Reviews</a></li>
            <li><a href="/Project/guide/">Guides</a></li>
            <li><a href="/Project/contact/">Contact</a></li>
        </ul>
    </nav>
    <?php
    }

    public function showFooter()
    {
    ?>
        <div class="footer-menu">
            <ul>
                <li><a href="/Project/">Home</a></li>
                <li><a href="/Project/news/">News</a></li>
                <li><a href="/Project/compare/">Comparator</a></li>
                <li><a href="/Project/brands/">Brands</a></li>
                <li><a href="/Project/reviews/">Reviews</a></li>
                <li><a href="/Project/guide/">Guides</a></li>
                <li><a href="/Project/contact/">Contact</a></li>
            </ul>
            <div class="social">
                <?php
                $this->showSocialMedia();
                ?>

            </div>

            <p>© 2023 AutoVS. All rights reserved.</p>
        </div>

        <?php
    }
    public function showSocialMedia()
    {
        $controller = new HomePageController();
        $socialMedia = $controller->getSocialMedia();
        foreach ($socialMedia as $media) {
        ?>
            <a href="<?php echo $media["URL"] ?>">
                <img src="/Project/public/images/<?php echo $media["ImagePath"] ?>" alt="<?php echo $media["Type"] ?>">
            </a>
        <?php
        }
    }
    public function showHeader()
    {
        ?>
        <div class="header-container">
            <div class="logo">
                <img src="/Project/public/images/logo1.png" alt="">
                <h2>AutoVS</h2>
            </div>
            <div class="social">
                <?php
                $this->showSocialMedia();
                ?>

            </div>
        </div>


    <?php
    }

    public function showVehicleCard($comparaison)
    {
    ?>
        <a class="featured-card" href="/Project/compare/vehicleID1=<?php echo $comparaison["VehicleID1"] ?>&vehicleID2=<?php echo $comparaison["VehicleID2"] ?>">
            <div class="images">
                <div><img style="transform: scaleX(-1);" src="/Project/public/images/<?php echo $comparaison["ImagePath1"] ?>" alt="<?php echo $comparaison["VehicleName1"] ?>"></div>
                <div>vs</div>
                <div><img src="/Project/public/images/<?php echo $comparaison["ImagePath2"] ?>" alt="<?php echo $comparaison["VehicleName2"] ?>"></div>
            </div>
            <div class="name">
                <div><?php echo $comparaison["VehicleName1"] ?></div>
                <div>VS</div>
                <div><?php echo $comparaison["VehicleName2"] ?></div>
            </div>
        </a>
    <?php
    }
    public function showCompareCard($title, $scale, $brands, $id)
    {
    ?>
        <div class="Compare">
            <img style="transform: scaleX(<?php echo $scale ?>);" src="/Project/public/images/compare1.png" alt="compare1">
            <h1><?php echo $title ?></h1>
            <form action="#" method="post">
                <div>
                    <label for="vehicle_picker_brand<?php echo $id ?>">Brand</label>
                    <select id="vehicle_picker_brand<?php echo $id ?>" name="vehicle_picker_brand">
                        <option value="" selected="">Choose a Brand</option>
                        <?php
                        foreach ($brands as $brand) {
                        ?>
                            <option value="<?php echo $brand['BrandID'] ?>"><?php echo $brand['Brand'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="vehicle_picker_model<?php echo $id ?>">Model</label>
                    <select id="vehicle_picker_model<?php echo $id ?>" name="vehicle_picker_model">
                        <option value="" selected="">Choose a Model</option>
                    </select>
                </div>
                <div>
                    <label for="vehicle_picker_version<?php echo $id ?>">Version</label>
                    <select id="vehicle_picker_version<?php echo $id ?>" name="vehicle_picker_version">
                        <option value="" selected="">Choose a Version</option>
                    </select>
                </div>
                <div>
                    <label for="vehicle_picker_year<?php echo $id ?>">Year</label>
                    <select id="vehicle_picker_year<?php echo $id ?>" name="vehicle_picker_year">
                        <option value="" selected="">Choose a Year</option>
                    </select>
                </div>


            </form>
        </div>
    <?php
    }
    public function showComprare()
    {
    ?>
        <div class="compare-div">
            <h1>Compare Vehiculs</h1>
            <p>Choose vehiculs to compare side-by-side.</p>
            <div>
                <div id="scrolldiv">
                    <?php
                    $controller = new AdminBrandsPageController();
                    $brands = $controller->getBrands();
                    $this->showCompareCard("Add first car", -1, $brands, 1);
                    $this->showCompareCard("Add second car", -1, $brands, 2);
                    $this->showCompareCard("Add third car", 1, $brands, 3);
                    $this->showCompareCard("Add forth car", 1, $brands, 4);
                    ?>
                </div>
            </div>
            <button class="compare-button">Compare</button>
        </div>

<?php
    }
    public function showDiaporama($diaporama)
    {
?>
        <div id="carouselAuto" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ">
                <?php

                
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
}

