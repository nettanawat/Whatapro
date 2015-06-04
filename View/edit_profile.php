<?php
include_once 'session.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>WAP / Edit profile</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <label class="titleFontSize">Edit profile</label>
            </div>
            <form role="form" name="inputeditaccount" action="" method="post">
                <?php

                if(0 == $user_type){

                }
                if(1 == $user_type){
                    $shopInformation = new ShopInformationDAOImpl();
                    $shop = $shopInformation->getShopInformationById($account->getAccountId());
                    echo '
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputName">Shop name</label>
                        <input type="text" class="form-control" name="inputName" required value='.$account->getName().'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input type="email" class="form-control" name="inputEmail" required value='.$account->getEmail().'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPhoneNumber">Phone number</label>
                        <input type="text" class="form-control " name="inputPhoneNumber"  required value='.$shop->getPhoneNumber().'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSubDistrict">Area</label>
                        <select name="comboDistrict" class="form-control" required>
                            <option></option>';
                            for($i=1; $i<11;$i++){
                                echo '<option value="'.$i.'"';
                                if($shop->getSubDistrict()==$i){ echo "selected"; } echo'> Suthep </option>';
                            }

                        echo '</select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputOpenAndCloseTime">Open and Close</label>
                            <input type="text" class="form-control" name="inputOpenAndCloseTime" required value="'.$shop->getOpenTime().'">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputImageLabel">Browse Image</label>
                        <input type="file" name="file">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="map">Pin your shop location on the map</label>
                        <div id="googleMap" ></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputLatitude">Latitude</label>
                        <input type="text" class="form-control" id="inputLatitude"  name="inputLatitude" required value="'.$shop->getLatitude().'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputLongitude">Longitude</label>
                        <input type="text" class="form-control" id="inputLongitude"  name="inputLongitude" required value="'.$shop->getLongitude().'">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label >A description for your shop</label>
                        <textarea class="form-control" name="inputDescription" rows="3" required >'.$shop->getDescription().'</textarea>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-default" href="account_list.php" role="button">Back</a>
                </div>
                    ';
                }
                ?>

            </form>
        </div><!-- /row -->
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<style>
    #googleMap{
        width: 100%;
        height:300px;
    }
</style>
<script>
    var userLat = <?php echo json_encode($shop->getLatitude()); ?>;
    var userLong = <?php echo json_encode($shop->getLongitude()); ?>;

    var myCenter = new google.maps.LatLng(userLat, userLong);

    function initialize() {
        var mapProp = {
            center: myCenter,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var marker = new google.maps.Marker({
            position: myCenter
        });

        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
