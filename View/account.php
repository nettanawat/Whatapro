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
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>

    <link rel="stylesheet" href="<?php echo Config::PATH.'/' ?>lightbox.css">
    <script type="text/javascript" src="<?php echo Config::PATH.'/' ?>google_jsapi.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

</head>
<body>
<div id="top" style="margin: 50px;"></div>

<div class="col-md-12" style="width: 100%; height: 300px;" id="map-canvas">
</div>
<input type="hidden" id="latitude" value="<?php echo $shopInfo->getLatitude(); ?>">
<input type="hidden" id="longitude" value="<?php echo $shopInfo->getLongitude(); ?>">

<div style="padding-bottom: 30px;" class="container">


    <h1 class="text-center"><?php echo $shopInfo->getName(); ?></h1>
        <div style="padding-bottom: 30px;" class="text-center col-md-12">
    <?php
    if ('admin' == $user_type) {

        echo '<a style="margin-top: 30px;" href="'.Config::PATH.'/account/edit/' . $shopInfo->getAccountId() . '" class="btn btn-default">Edit this shop</a>';
    }
    ?>
    </div>
    <div class="form-group col-md-3">
        <strong>Email : </strong>

        <p class="col-md-12"><span class="glyphicon glyphicon-earphone"></span> <?php echo $account->getEmail(); ?></p>
    </div>
    <div class="form-group col-md-2">
        <strong>Phone number : </strong>

        <p class="col-md-12"><span class="glyphicon glyphicon-phone-alt"></span> <?php echo $shopInfo->getPhoneNumber(); ?></p>
    </div>
    <div class="form-group col-md-3">
        <strong>Open and close time : </strong>

        <p class="col-md-12"><span class="glyphicon glyphicon-time"></span> <?php echo $shopInfo->getOpenTime(); ?></p>
    </div>
    <div class="form-group col-md-4">
        <strong>Address : </strong>

        <p class="col-md-12"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $shopInfo->getAddress(); ?></p>
    </div>
    <div class="form-group col-md-12">
        <strong>Description</strong>

        <p class="col-md-12"><span class="glyphicon glyphicon-book"></span> <?php echo $shopInfo->getDescription(); ?></p>
    </div>
</div>
<div class="container-fluid text-center">
    <h3>SHOP IMAGES</h3>
    <div class="image-row">
        <div class="image-set">
            <?php
            if($shopImage == null){
                    echo '<div class="col-md-12 text-center"> <img width="100%" class="col-md-4" src="'.Config::PATH.'/img/noimage.png"> </div>';
            } else {
                foreach ($shopImage as $image) {
                    echo '
                    <div style="padding-bottom: 20px;" class="col-md-3">
                        <a class="example-image-link" href="'. Config::PATH.'/' . $image->getImagePath() . '" data-lightbox="example-set">
                        <img width="250px" height="250px;" class="example-image imgborder img-circle" src="'. Config::PATH.'/' . $image->getImagePath() . '" alt=""/></a>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</div>

<div style="margin-top: 20px; padding-bottom: 50px" class="container-fluid text-center">
    <h3 class="col-md-12">Current promotions</h3>

    <div class="col-md-12 shadow">
        <?php
        foreach ($promotionList as $promotion) {
            $promotionImageController = new PromotionImageController();
            $promotionImage = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
            $startDate = new DateTime($promotion->getStartDate());

            $endDate = new DateTime($promotion->getEndDate());

            $imagePromotionBackground = '';

            if($promotionImage == null) {
                $imagePromotionBackground = Config::PATH.'/img/noimage.png';
            } else {
                $imagePromotionBackground = Config::PATH.'/'.$promotionImage[0]->getImagePath();
            }

            echo('
                    <div class="col-md-4">
                            <div style="background-image: url(' . $imagePromotionBackground . '); background-size: cover;" class="col-md-12 promotionboxtop divbutton text-center container-fluid">
                                    <a id="view" href="'.Config::PATH.'/promotion/'. $promotion->getPromotionId() . '" style="display: none; background-color: rgba(255,255,255,0.5); color: #ffffff" class="viewpromotion btn btn-default">View Promotion</a>
                            </div>
                            <div class="col-md-12 promotionboxbtm text-center">
                                <p class="textinpromotionbox">' . $promotion->getName() . '</p>
                                <p>' . $startDate->format('D M j Y') . ' - ' . $endDate->format('D M j Y') . '</p>
                            </div>
                    </div>
                        ');
        }
        ?>
    </div>
</div>

<div class="container-fluid text-center">
    <p>Copyright &copy; nettanawat 2015 All rights reserved</p>
</div>

<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo Config::PATH.'/accounts';?>"><strong style="text-decoration: none; color: orangered">Back</strong></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo Config::PATH.'/account/'.$shopInfo->getAccountId();?>#top"><strong style="text-decoration: none; color: orangered">Back to top</strong></a></li>
        </ul>
    </div>
</nav>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Config::PATH.'/' ?>js/jquery-1.11.0.min.js"></script>
<script src="<?php echo Config::PATH.'/' ?>js/lightbox.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('mouseenter', '.divbutton',function () {
            $(this).find("a").show();
        }).on('mouseleave', '.divbutton', function () {
            $(this).find("a").hide();
        });
    });

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


