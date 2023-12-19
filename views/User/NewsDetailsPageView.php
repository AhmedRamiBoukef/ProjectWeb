<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/User/NewsPageController.php');

class NewsDetailsPageView extends LayoutView
{

    
    public function showNewsDetails($id)
{
    $controller = new NewsPageController();
    $news = $controller->getNewsByID($id); 

    $images = array_map(function ($imagePath) {
        return [
            'SlideshowLinkURL' => '#',  
            'SlideshowImagePath' => $imagePath,
        ];
    }, $news['Images']);

    ?>
    <div class="news-details">
        <div class="news-header">
            <div>
                <h1><?= $news['Title'] ?></h1>
                <p>Published · <?= date('jS M Y', strtotime($news['Date'])) ?></p>
            </div>
            <div>
                <img src="/Project/public/images/<?= $news['Images'][0] ?>" alt="<?= $news['Images'][0] ?>">
            </div>
        </div> 
        <?php
        // $this->showDiaporama($images);
        ?>
        <p>
            <?= $news['Content'] ?>
        </p>
    </div>
    <?php
}

    public function showNewsDetailsPage($id)
    {
        $this->showHeader();
        $this->showMenu();
        $this->showNewsDetails($id);
        $this->showFooter();
    }
    
}

?>