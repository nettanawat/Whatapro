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
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../google_jsapi.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
        // If you're adding a number of markers, you may want to drop them on the map
        // consecutively rather than all at once. This example shows how to use
        // window.setTimeout() to space your markers' animation.

        var berlin = new google.maps.LatLng(52.520816, 13.410186);

        var neighborhoods = [
            new google.maps.LatLng(52.511467, 13.447179),
            new google.maps.LatLng(52.549061, 13.422975),
            new google.maps.LatLng(52.497622, 13.396110),
            new google.maps.LatLng(52.517683, 13.394393)
        ];

        var markers = [];
        var map;

        function initialize() {
            var mapOptions = {
                zoom: 12,
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
</head>
<body>
<div style="margin: 55px;"></div>

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
                $amountOfAccounts = sizeof(AccountController::getAllAccount());
                $lastFiveAccounts = array_slice(AccountController::getAllAccount(), -5);
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
                <a href="account_list.php" class="btn btn-default btn-sm">see more</a>
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
                <a href="account_list.php" class="btn btn-default btn-sm">see more</a>
            </div>
        </div>
    </div> <!--row-->
</div><!--container-->
</body>
</html>
