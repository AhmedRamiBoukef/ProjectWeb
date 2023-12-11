<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/views/LayoutView.php');
class HomePageView extends LayoutView
{
    public function content()
    {
?>
        <div class="category">
            <div class="cont">

                <div class="cat">
                    <a href="/Project/Admin/users/" >
    
                            <img src="/Project/Admin/public/images/admin.jpg" alt="" height="100%" width="100%" style="object-fit:cover">
                            <h1 class="centered">Users</h1>
    
                    </a>
                </div>
                <div class="cat">
                    <a href="/Project/Admin/brands/">
    
                            <img src="/Project/Admin/public/images/cars.jpg" alt="" height="100%" width="100%" style="object-fit:cover">
                            <h1 class="centered">Brands & Cars</h1>
    
                    </a>
                </div>
    
    
                <div class="cat">
                    <a href="/Project/Admin/news/">
    
                            <img src="/Project/Admin/public/images/news.jpg" alt="" height="100%" width="100%" style="object-fit:cover">
                            <h1 class="centered">News</h1>
    
                    </a>
                </div>
    
    
                <div class="cat">
                    <a href="/Project/Admin/reviews">
    
                            <img src="/Project/Admin/public/images/review.jpg" alt="" height="100%" width="100%" style="object-fit:cover">
                            <h1 class="centered">Reviews</h1>
    
                    </a>
                </div>
            </div>



            <div class="cat cat5">
                <a href="/Project/Admin/settings/">
                        <img src="/Project/Admin/public/images/settings.jpg" alt="" height="100%" width="100%" style="object-fit:cover">
                        <h1 class="centered">Settings</h1>

                </a>
            </div>

        </div>
<?php
    }
    public function showHomePage()
    {
        $this->showNavbar();
        $this->content();
    }


}