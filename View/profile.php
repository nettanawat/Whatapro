<?php
include_once 'session.php';
if (isset($_GET['accountId'])) {

    $account = AccountController::getAccountById($_GET['accountId']);
    $shopInfo = ShopInformationController::getShopInformationById($_GET['accountId']);
    $shopImageController = new ShopImageController();
    $shopImage = $shopImageController->getImageByAccountId($account->getAccountId());
    $promotionImageController = new PromotionImageController();
    $promotionList = PromotionController::getPromotionByShopId($account->getAccountId());
//    $promotionImage = $promotionImageController->getPromotionImageByPromotionId();
}
?>
<html>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../google_jsapi.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

</head>
<body>
<div style="margin: 55px;"></div>

<div class="col-md-12" style="width: 100%; height: 300px;" id="map-canvas">
</div>
<input type="hidden" id="latitude" value="<?php echo $shopInfo->getLatitude(); ?>">
<input type="hidden" id="longitude" value="<?php echo $shopInfo->getLongitude(); ?>">

<div style="padding-bottom: 30px;" class="container">
    <div class="row">
        <h2><?php echo $shopInfo->getName(); ?></h2>

        <div class="form-group col-md-2">
            <strong>Email : </strong>

            <p class="col-md-12"><?php echo $account->getEmail(); ?></p>
        </div>
        <div class="form-group col-md-2">
            <strong>Phone number : </strong>

            <p class="col-md-12"><?php echo $shopInfo->getPhoneNumber(); ?></p>
        </div>
        <div class="form-group col-md-4">
            <strong>Open and close time : </strong>

            <p class="col-md-12"><?php echo $shopInfo->getOpenTime(); ?></p>
        </div>
        <div class="form-group col-md-4">
            <strong>Address : </strong>

            <p class="col-md-12"><?php echo $shopInfo->getAddress(); ?></p>
        </div>
        <div class="form-group col-md-12">
            <strong>Description</strong>

            <p class="col-md-12"><?php echo $shopInfo->getDescription(); ?></p>
        </div>
        <hr class="col-md-12">
        <div style="padding-bottom: 20px;" class="col-md-12">
            <?php
            foreach ($shopImage as $image) {
                echo '<img style="padding-bottom:20px;" height="220px" class="col-md-4"  src="' . $image->getImagePath() . '">';
            }
            ?>
            <hr class="col-md-12">
        </div>
        <h3>Current promotions</h3>

        <div class="col-md-12">
            <div class="col-md-4 shadow">

                <?php
                foreach ($promotionList as $promotion) {
                    $promotionImageController = new PromotionImageController();
                    $promotionImage = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
                    $startDate = new DateTime($promotion->getStartDate());

                    $endDate = new DateTime($promotion->getEndDate());


                    echo('
                            <div style="background-image: url(' . $promotionImage[0]->getImagePath() . '); background-size: cover;" class="col-md-12 promotionboxtop divbutton text-center container-fluid">
                                    <a href="" style="display: none; background-color: rgba(255,255,255,0.5); color: #ffffff" class="viewpromotion btn btn-default">View Promotion</a>
                            </div>
                            <div class="col-md-12 promotionboxbtm text-center">
                                <p class="textinpromotionbox">' . $promotion->getName() . '</p>
                                <p>' . $startDate->format('D M j Y') . ' - ' . $endDate->format('D M j Y') . '</p>
                            </div>
                        ');
                }
                ?>
            </div>
        </div>
    </div>
    <!--row-->
</div>
<!--container-->
<script>
    $(document).ready(function () {
        $(document).on('mouseenter', '.divbutton',function () {
            $(this).find("a").show();
        }).on('mouseleave', '.divbutton', function () {
            $(this).find("a").hide();
        });
    });
</script>
<script>
    var lat = document.getElementById("latitude").value;
    var long = document.getElementById("longitude").value;

    var coordinate = new google.maps.LatLng(lat, long);

    var neighborhoods = [
        coordinate
    ];

    var markers = [];
    var map;

    function initialize() {
        var mapOptions = {
            zoom: 15,
            center: coordinate
        };

        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        drop();
    }

    function drop() {
        clearMarkers();
        for (var i = 0; i < neighborhoods.length; i++) {
            addMarkerWithTimeout(neighborhoods[i], i * 200);
        }
    }

    function addMarkerWithTimeout(position, timeout) {
        window.setTimeout(function () {
            markers.push(new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP
            }));
        }, timeout);
    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
