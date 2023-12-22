<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/Admin/BrandsPageController.php');


class LayoutView
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
            <a href="/Project/" class="logo">
                <img src="/Project/public/images/logo1.png" alt="">
                <h2>AutoVS</h2>
            </a>
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
        <a class="featured-card" href="/Project/compare/?vehicleID1=<?php echo $comparaison["VehicleID1"] ?>&vehicleID2=<?php echo $comparaison["VehicleID2"] ?>">
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
    public function showCompare()
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


                $i = 0;
                foreach ($diaporama as $slide) {
                    if ($i == 0) {
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
                    $i = $i + 1;
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
    public function showStars($rating)
    {
        $fullStarCount = floor($rating);
        $halfStar = $rating - $fullStarCount >= 0.5;

        for ($i = 0; $i < $fullStarCount; $i++) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>';
        }

        if ($halfStar) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-star-half" viewBox="0 0 16 16">
              <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
              </svg>';
        }

        for ($i = 0; $i < 5 - $fullStarCount - $halfStar; $i++) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>';
        }
    }
    public function showPopular($id)
    {
    ?>
        <div class="popular">
            <h1>Popular car comparisons</h1>
            <p>Here’s how the most-searched-for-vehiculs on the road differ.</p>
            <div>
                <?php
                $controller = new HomePageController();
                foreach ($controller->getComparaison($id) as $comparaison) {
                    $this->showVehicleCard($comparaison);
                }

                ?>
            </div>

        </div>
<?php
    }
}
