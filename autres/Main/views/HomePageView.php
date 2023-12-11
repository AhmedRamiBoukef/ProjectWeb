<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Main/views/LayoutView.php');
class HomePageView extends LayoutView
{
    public function showDiaporama() {
        ?>
        <div id="carouselAuto" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="./public/images/car1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./public/images/car2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./public/images/car3.jpg" class="d-block w-100" alt="...">
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
    
    public function showHomePage()
    {
        $this->showHeader();
        $this->showDiaporama();
        $this->showMenu();
        $this->showFooter();
    }
}