<!DOCTYPE html>
<html>
<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    $_SESSION['error_info'] = "You do not have sufficient permissions to access this page";
    header('Location: error_message.php');
    exit;
}
?>
<head>
    <title>WAP / Request Detail</title>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>
</head>
<body>

<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="row">
            <form role="form" name="requestdeailform" action="take_manage_request.php" method="post">
                <?php
                $adaptor = new Adaptor();
                $adminContolller = new AdminController();
                $requestDetail = $adminContolller->getRequestDetail($_GET['request_id']);
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputName">Shop name</label>
                        <input type="text" class="form-control" name="inputName" required
                               value="<?php printf($requestDetail->getName()); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input type="email" class="form-control" name="inputEmail" required
                               value="<?php printf($requestDetail->getEmail()); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPhoneNumber">Phone number</label>
                        <input type="text" class="form-control bfh-phone" name="inputPhoneNumber" required
                               value="<?php printf($requestDetail->getPhoneNumber()); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSubDistrict">Area</label>
                        <select name="comboDistrict" class="form-control" required>
                            <option></option>
                            <option value="1" <?php if ($requestDetail->getSubDistrict() == 1) echo "selected"; ?>>
                                Suthep
                            </option>
                            ;
                            <option value="2" <?php if ($requestDetail->getSubDistrict() == 2) echo "selected"; ?>> Nai
                                Maung
                            </option>
                            ;
                            <option value="3" <?php if ($requestDetail->getSubDistrict() == 3) echo "selected"; ?>> Si
                                Phum
                            </option>
                            ;
                            <option value="4" <?php if ($requestDetail->getSubDistrict() == 4) echo "selected"; ?>> Phra
                                Sing
                            </option>
                            ;
                            <option value="5" <?php if ($requestDetail->getSubDistrict() == 5) echo "selected"; ?>>
                                Chang Phueak
                            </option>
                            ;
                            <option value="6" <?php if ($requestDetail->getSubDistrict() == 6) echo "selected"; ?>> Mae
                                Hia
                            </option>
                            ;
                            <option value="7" <?php if ($requestDetail->getSubDistrict() == 7) echo "selected"; ?>> Pa
                                Daet
                            </option>
                            ;
                            <option value="8" <?php if ($requestDetail->getSubDistrict() == 8) echo "selected"; ?>> Pa
                                Tan
                            </option>
                            ;
                            <option value="9" <?php if ($requestDetail->getSubDistrict() == 9) echo "selected"; ?>>
                                Chang Moi
                            </option>
                            ;
                            <option value="10" <?php if ($requestDetail->getSubDistrict() == 10) echo "selected"; ?>>
                                Chang Khlan
                            </option>
                            ;
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputOpenAndCloseTime">Open and Close</label>
                            <input type="text" class="form-control" name="inputOpenAndCloseTime" required
                                   value="<?php printf($requestDetail->getOpenTime()); ?>">
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

                        <div id="googleMap"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputLatitude">Latitude</label>
                        <input type="text" class="form-control" id="inputLatitude" name="inputLatitude" required
                               value="<?php printf($requestDetail->getLatitude()); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputLongitude">Longitude</label>
                        <input type="text" class="form-control" id="inputLongitude" name="inputLongitude" required
                               value="<?php printf($requestDetail->getLongitude()); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>A description for your shop</label>
                        <textarea class="form-control" name="inputDescription" rows="3"
                                  required><?php printf($requestDetail->getDescription()); ?></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-1">
                        <a class="btn btn-success" href="request_signup_list.php" role="button">Back</a>
                    </div>
                    <div class="col-md-1">
                        <?php
                        if ($requestDetail->getStatus() == 0) {
                            printf("
                                            <input type=text value=" . $requestDetail->getId() . " name='inputId' hidden >
                                                <button type=submit name='action' value='approve' class='btn btn-primary'>Approve</button>

                                            ");
                        } else {
                            printf("
                                                <button type=submit name='action' value='approve' class='btn btn-default' disabled>Approve</button>
                                            ");
                        }
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
                        if ($requestDetail->getStatus() == 0) {
                            printf("
                                            <input type=text value=" . $requestDetail->getId() . " name='inputId' hidden >
                                                <button type=submit name='action' value='approve' class='btn btn-danger'>Reject</button>

                                            ");
                        } else {
                            printf("
                                                <button type=submit name='action' value='approve' class='btn btn-default' disabled>Reject</button>
                                            ");
                        }
                        ?>
                    </div>
                    <div class="col-md-7">
                    </div>
                </div>

            </form>
        </div>
        <!-- /row -->
    </div>

</div>
<!-- /container -->

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<style>
    #googleMap {
        width: 100%;
        height: 300px;
    }
</style>
<script>
    var userLat = <?php echo json_encode($requestDetail->getLatitude()); ?>;
    var userLong = <?php echo json_encode($requestDetail->getLongitude()); ?>;

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
