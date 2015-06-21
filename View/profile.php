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
    <!--    <link rel="stylesheet" href="../screen.css">-->
    <link rel="stylesheet" href="../lightbox.css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../google_jsapi.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

</head>
<body>
<div id="top" style="margin: 55px;"></div>

<div class="col-md-12" style="width: 100%; height: 300px;" id="map-canvas">
</div>
<input type="hidden" id="latitude" value="<?php echo $shopInfo->getLatitude(); ?>">
<input type="hidden" id="longitude" value="<?php echo $shopInfo->getLongitude(); ?>">

<div style="padding-bottom: 30px;" class="container">


    <h1 class="text-center"><?php echo $shopInfo->getName(); ?></h1>
    <div class="col-md-12">
    <?php
    if ('admin' == $user_type) {

        echo '<a style="margin-top: 30px;" href="edit_account.php?userId=' . $shopInfo->getAccountId() . '" class="btn btn-default">Edit this shop</a>';
    }
    ?>
    </div>
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
</div>
<div class="container-fluid text-center">
    <h3>SHOP IMAGES</h3>
    <div class="image-row">
        <div class="image-set">
            <?php
            foreach ($shopImage as $image) {
                echo '
                    <div class="col-md-3">
                        <a class="example-image-link" href="' . $image->getImagePath() . '" data-lightbox="example-set">
                        <img width="100%" class="example-image" src="' . $image->getImagePath() . '" alt=""/></a>
                    </div>
                    ';
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


            echo('
                    <div class="col-md-4">
                            <div style="background-image: url(' . $promotionImage[0]->getImagePath() . '); background-size: cover;" class="col-md-12 promotionboxtop divbutton text-center container-fluid">
                                    <a href="promotion.php?promotionId=' . $promotion->getPromotionId() . '" style="display: none; background-color: rgba(255,255,255,0.5); color: #ffffff" class="viewpromotion btn btn-default">View Promotion</a>
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
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#top"><strong style="text-decoration: none; color: orangered">Back to top</strong></a></li>
        </ul>
    </div>
</nav>
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
<script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/lightbox.js"></script>
</body>
</html>
