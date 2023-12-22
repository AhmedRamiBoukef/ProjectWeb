<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/User/NewsPageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/Controllers/User/ReviewPageController.php');

class VehicleDetailsPageView extends LayoutView
{

    public function showDetailsCard($data) {
        if ($data['title'] == "Note & Price") {
            ?>
            <div>
                <a class="collapsee">
                    <h4><?= $data['title'] ?></h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#0071eb" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                    </svg>
                </a>
                <div>
                    <div>
                        <h3>Note</h3>
                        <p><?= $data['data']['Note'] ?> / 5 <?php $this->showStars($data['data']['Note']) ?></p>
                    </div>
                    <div>
                        <h3>Price</h3>
                        <p><?= $data['data']['IndicativePrice'] ?></p>
                    </div>
                </div>
            </div>
        <?php
        }else {
        ?>

            <div>
                <a class="collapsee">
                    <h4><?= $data['title'] ?></h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#0071eb" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                    </svg>
                </a>
                <div>
                <?php
                    foreach ($data['data'] as $key => $value) {
                        ?>
                            <div>
                                <h3><?= $key ?></h3>
                                <p><?= $value ?></p>
                            </div>
                        <?php
                    }
                 ?>
                </div>
            </div>
        <?php
        }
    }

    
    public function showVehicleDetails($id)
{
    $controller = new VehiclePageController();
    $vehicle = $controller->getVehicleByID($id);

    ?>
    <div class="vehicle-details">
        <div class="vehicle-details-head">
            <div>
                <div>
                    <div>
                        <img src="/Project/public/images/<?= $vehicle["Logo"] ?>" alt="<?= $vehicle["Logo"] ?>">
                    </div>
                    <h1><?= $vehicle["VehiculeName"] ?></h1>
                </div>
                <div>
                    Starts at <h2><?= $vehicle["IndicativePrice"] ?></h2>
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#Modal">Compare</button>
                <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Compare <?= $vehicle["VehiculeName"] ?> with other vehicles</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div id="modalcompare">
                                <div>
                                    <input id="selectedVehicule" type="hidden" value="<?= $id ?>">
                                    <?php
                                        $controller = new AdminBrandsPageController();
                                        $brands = $controller->getBrands();
                                        $this->showCompareCard("Add second car", -1, $brands, 2);
                                        $this->showCompareCard("Add third car", 1, $brands, 3);
                                        $this->showCompareCard("Add forth car", 1, $brands, 4);
                                    ?>
                                </div>
                            </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="modalcompareButton">Compare</button>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div>
                <img src="/Project/public/images/<?= $vehicle["VehicleImage"] ?>" alt="<?= $vehicle["VehicleImage"] ?>">
            </div>
        </div>
        <div class="vehicle-details-body">
            <div class="vehicle-details-card">
                <?php
                $sections = [
                    "Overview" => ["BrandName", "ModelName", "Version", "ModelYear"],
                    "Note & Price" => ["Note", "IndicativePrice"],
                    "Engine Specifications" => ["EngineName", "EngineType", "Power"],
                    "Performance" => ["Acceleration", "TopSpeed"],
                    "Consumption" => ["Consumption"],
                    "Dimensions & Capacity" => ["Dimensions", "Capacity","VitesseTYPE"],
                ];

                foreach ($sections as $sectionTitle => $sectionFields) {
                    $sectionData = array_intersect_key($vehicle, array_flip($sectionFields));
                    $this->showDetailsCard(['title' => $sectionTitle, 'data' => $sectionData]);
                }
                ?>
                
            </div>
        </div>
    </div>
    <?php
}
    public function showReviewCard($review) {
        ?>
        <div class="Review-Card">
            <div>
                <div><?= strtoupper($review['UserName'][0]); ?></div>
                <div>
                    <div><?= $review['UserName']; ?></div>
                    <div>
                        <div><?php $this->showStars($review['Rating']) ?></div>
                        <span><?= date('jS M Y', strtotime($review['Date'])) ?></span>
                    </div>
                </div>
            </div>
            <div>
                <?= $review['Comment']; ?>
            </div>
        </div>
        <?php
    }
    public function showReviews($id) {
        ?>
        <div class="Review-Container">
            <h1>Popular Reviews</h1>
            <p>Here’s how the most-popular reviews for this car.</p>
        <?php
            $controller = new ReviewPageController();
            $reviews = $controller->getPopularReviews($id);
            foreach ($reviews as $review) {
                $this->showReviewCard($review);
            }
            ?>
            <a href="/Project/reviews/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16"><path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/></svg> View All Reviews</a>
        </div>
        <?php
    }
    public function showAddReviews() {
        ?>
        <div class="Add-Review-Container">
            <h1>Add a Review</h1>
            <p>Have you driven this Vehicle? Rate it</p>
            <form id="reviewForm" action="/Project/Api/api.php" method="post">
                <div>
                    <textarea name="review" id="review" cols="30" rows="10" placeholder="Enter your review"  ></textarea>
                </div>
                <div class="give-rate">
                    <label for="note">Note : </label>
                    <input type="hidden" name="note" id="note" value="0">
                    <div class="rating--star">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="rating-star bi bi-star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="rating-star bi bi-star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="rating-star bi bi-star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="rating-star bi bi-star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="rating-star bi bi-star" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                </div>
                <button type="button" id="ReviewSubmitButton">Submit</button>
            </form>
        </div>
        <?php
    }

    public function showVehicleDetailsPage($id)
    {
        $this->showHeader();
        $this->showMenu();
        $this->showVehicleDetails($id);
        $this->showReviews($id);
        $this->showAddReviews();
        $this->showPopular($id);
        $this->showFooter();
    }
    
}

?>