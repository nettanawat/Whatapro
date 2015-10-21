<?php

include_once '../Config.php';

if (isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['inputName']) && isset($_POST['inputAddress'])) {
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $name = $_POST['inputName'];
    $address = $_POST['inputAddress'];
    $phoneNumber = $_POST['inputPhoneNumber'];
    $subDistrict = $_POST['comboDistrict'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $openTime = $_POST['inputOpenAndCloseTime'];
    $description = $_POST['inputDescription'];
    $requestDate = '';
    $approveDate = null;
    $manageBy = null;
    $status = 2;

    RequestSignupController::addRequest(new RequestSignupInfo("",$email,$password,$name,$address,$phoneNumber,$subDistrict,$latitude,$longitude,$openTime,$description,$requestDate,$approveDate,$manageBy,$status));
    header('Location: '.Config::PATH);
    exit;
}
?>
<html>
<head>
    <title>WAP / Request sign up</title>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>
    <style>
        #googleMap {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img width="80px" src="../Whatapro/img/logo.png">
        </div>
        <div class="navbar-collapse collapse">

        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div style="margin: 80px;" class="container-fluid">

    <div class="row">
        <form name="inputeditaccount" id="addAccountForm" action="" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <label class="titleFontSize">New account</label>
            </div>
            <div class="col-md-6">
                <div class="form-group shopName">
                    <label class="control-label" for="inputError2">Shop name</label>
                    <input id="shopName" type="text" class="form-control" name="inputName" placeholder="WAP shop" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group email">
                    <label class="control-label" for="inputError2">Email address</label>
                    <input type="email" class="form-control" name="inputEmail" placeholder="wapbar@wap.com"
                           required onkeyup="checkExistingEmail(this.value)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group password">
                    <label class="control-label" for="inputError2">Create a password</label>
                    <input id="password" type="password" class="form-control" name="inputPassword" placeholder="Your Password"
                           required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group confirmPassword">
                    <label class="control-label" for="inputError2">Confirm Password</label>
                    <input id="confirmPassword" type="password" class="form-control" name="inputPasswordAgain"
                           placeholder="Confirm Password" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group phoneNumber">
                    <label class="control-label" for="inputPhoneNumber">Phone number</label>
                    <input id="phoneNumber" type="text" class="form-control bfh-phone" name="inputPhoneNumber"
                           placeholder="053222222" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <div class="form-group openAndCloseTime">
                        <label class="control-label" for="inputOpenAndCloseTime">Open and Close</label>
                        <input id="openAndCloseTime" type="text" class="form-control" name="inputOpenAndCloseTime"
                               placeholder="Mon - Sat from 09.00-23.00" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group address">
                    <label class="control-label" for="inputAddress">Address</label>
                    <input id="address" type="text" class="form-control" name="inputAddress"
                           placeholder="40 Nimmarnhemin Rd., T.Suthep, A.Muang, Chiang Mai, 50200" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSubDistrict">Area</label>
                    <select name="comboDistrict" class="form-control" required>
                        <option></option>
                        <option value="1"> Suthep</option>
                        ;
                        <option value="2"> Nai Maung</option>
                        ;
                        <option value="3"> Si Phum</option>
                        ;
                        <option value="4"> Phra Sing</option>
                        ;
                        <option value="5"> Chang Phueak</option>
                        ;
                        <option value="6"> Mae Hia</option>
                        ;
                        <option value="7"> Pa Daet</option>
                        ;
                        <option value="8"> Pa Tan</option>
                        ;
                        <option value="9"> Chang Moi</option>
                        ;
                        <option value="10"> Chang Khlan</option>
                        ;
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="map">Pin your shop location on the map</label>
                    <div id="googleMap"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group inputLatitude">
                    <label class="control-label" for="inputLatitude">Latitude</label>
                    <input type="text" class="form-control" id="inputLatitude" name="latitude" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group inputLatitude">
                    <label class="control-label" for="inputLongitude">Longitude</label>
                    <input type="text" class="form-control" id="inputLongitude" name="longitude" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group description">
                    <label class="control-label" >A description for this shop</label>
                    <textarea id="description" class="form-control" name="inputDescription" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-warning">
                    <label class="control-label">Terms and Conditions</label>
                    <textarea class="form-control" name="termAndConditions" rows="3" readonly="readonly">
                        By registering here and creating your "WAP Account", you can access different services that are
                        offered by us without having to register for each service separately. If a service you wish to
                        subscribe to has additional terms and conditions, you will be asked to accept these separately.
                        You agree that:
                        (1) you will keep your email and password safe, and won't share them with anyone.
                        (2) you will not pass yourself off as someone else or create multiple, false accounts.
                    </textarea>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inputCheckbox" required> I agree to WAP's terms and
                            conditions</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <a class="btn btn-default" href="account_list.php" role="button">Back</a>
                <input id="submitAddBtn" type="submit" value="Submit" name="add" class="btn btn-default"/>
            </div>
        </form>
        <!-- /row -->
    </div>



</div>
<!-- /row -->
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="Whatapro/accountvalidation.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript">

    var myCenter = new google.maps.LatLng(18.789570, 98.974244);
    var geocoder;
    var infowindow = new google.maps.InfoWindow();
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapProp = {
            center: myCenter,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        google.maps.event.addListener(map, 'click', function (event) {
            placeMarker(event.latLng);
        });
    }
    var marker;
    function placeMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }

        var latlng = new google.maps.LatLng(location.lat(), location.lng());
        geocoder.geocode({'latLng': latlng}, function (results) {
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(map, marker);
//            document.inputeditaccount.temp.value = results[1].formatted_address;
        });

        document.inputeditaccount.latitude.value = location.lat();
        document.inputeditaccount.longitude.value = location.lng();
        isValidateLatitude();
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
</html>
