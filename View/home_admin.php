<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: error_message.php');
    exit;
}
?>
<html>
<head>
    <?php

    $assetPath = Config::PATH.'/';

    include_once '../assets.php'

    ?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['bar']}]}"></script>
</head>
<body>
<div style="margin: 50px;"></div>

<div class="col-md-12" style="width: 100%; height: 500px;" id="map-canvas">
</div>
<div style="padding-bottom: 30px;" class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>5 Newest accounts</h3>
            <table class="table table-condensed table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join date</th>
                    <th>Status</th>
                </tr>
                <?php

                $shopInformationList = ShopInformationController::getAllShopInformation();
                $latitudes = array();
                $longitudes = array();
                $shopNames = array();
                $promotionAmount = array();
                foreach($shopInformationList as $shop) {
                    $latitudes[] = $shop->getLatitude();
                    $longitudes[] = $shop->getLongitude();
                    $shopNames[] = $shop->getName();
                    $promotionAmount[] = sizeof(PromotionController::getPromotionByShopId($shop->getAccountId()));
                }

                $lastFiveAccounts = AccountController::getLastFiveAccount();
                $adaptor = new Adaptor();
                foreach ($lastFiveAccounts as $account) {
                    $adaptor->setStatus($account->getStatus());
                    $shopInfo = ShopInformationController::getShopInformationById($account->getAccountId());
                    $shopName = '-';
                    if($shopInfo->getName() != null){
                        $shopName = $shopInfo->getName();
                    }
                    echo '<tr>
                        <td>' . $account->getAccountId() . '</td>
                        <td>' . $shopName . '</td>
                        <td>' . $account->getEmail() . '</td>
                        <td>' . $account->getJoinDate() . '</td>
                        <td>' . $adaptor->getStatus() . '</td>
                        </tr>';
                } ?>
            </table>
            <div style="margin-top: -10px;" class="text-right">
                <a href="<?php echo Config::PATH."/accounts"; ?>" class="btn btn-default btn-sm">see more</a>
            </div>
        </div>

        <div class="col-md-6">
            <h3>5 Newest promotions</h3>
            <table class="table table-condensed table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Shop name</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Status</th>
                </tr>
                <?php
                $amountOfAccounts = sizeof(AccountController::getAllAccount());
                $lastFivePromotions = array_slice(PromotionController::getAllPromotion(), -5);
                $adaptor = new Adaptor();
                foreach ($lastFivePromotions as $promotion) {
                    $adaptor->setStatus($promotion->getStatus());
                    $shopInfo = ShopInformationController::getShopInformationById($promotion->getAccountId());
                    $startDate = new DateTime($promotion->getStartDate());
                    $endDate = new DateTime($promotion->getEndDate());
                    echo '<tr>
                        <td>' . $promotion->getPromotionId() . '</td>
                        <td>' . $promotion->getName() . '</td>
                        <td>' . $shopInfo->getName() . '</td>
                        <td>' . $startDate->format('Y-m-d') . '</td>
                        <td>' . $endDate->format('Y-m-d') . '</td>
                        <td>' . $adaptor->getStatus($promotion->getStatus()) . '</td>
                        </tr>';
                } ?>
            </table>
            <div style="margin-top: -10px;" class="text-right">
                <a href="<?php echo Config::PATH."/promotions"; ?>" class="btn btn-default btn-sm">see more</a>
            </div>
        </div>
        <div style="padding-top: 20px" class="col-md-12 text-center">
            <h2>Overall promotion in system</h2>
        </div>
        <div class="col-md-12" id="chart_div" style="width: 100%; height: 500px;"></div>
    </div> <!--row-->
</div><!--container-->
<script>

    var latitudes= <?php echo json_encode($latitudes ); ?>;
    var longitude= <?php echo json_encode($longitudes ); ?>;



    // If you're adding a number of markers, you may want to drop them on the map
    // consecutively rather than all at once. This example shows how to use
    // window.setTimeout() to space your markers' animation.

    var berlin = new google.maps.LatLng(18.789570, 98.974244);
    var neighborhoods =[];
    for(var i=0; i<longitude.length; i++){
        neighborhoods[i] = new google.maps.LatLng(latitudes[i], longitude[i]);
    }

    var markers = [];
    var map;

    function initialize() {
        var mapOptions = {
            zoom: 14,
            center: berlin
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
        window.setTimeout(function() {
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
<script type="text/javascript">
        google.load('visualization', '1', {packages: ['corechart', 'bar']});
        google.setOnLoadCallback(drawBasic);
        var shopNames= <?php echo json_encode($shopNames ); ?>;
        var promotionAmount = <?php echo json_encode($promotionAmount ); ?>;
        var shop;
        for(var i=0; i<shopNames.length;i++){
            shop = [shopNames[i], promotionAmount[i]];
        }

        function drawBasic() {
            var data = google.visualization.arrayToDataTable(
                [
                    ['Shop name', 'Currently promotion'],
                    ['Coffee smith', 2],
                    ['Warm up cafe', 3],
                    ['iLike ice cream', 5],
                    ['Ristr8to', 0],
                    ['madbar', 2]
                ]
            );

            var options = {
                chartArea: {width: '70%'},
                hAxis: {
                    title: 'Total Promotion',
                    minValue: 0
                },
                vAxis: {
                    title: 'Shop'
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
</script>
</body>
</html>
