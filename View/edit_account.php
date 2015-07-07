<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    $_SESSION['error_info'] = "You do not have sufficient permissions to access this page";
    header('Location: '.Config::PATH.'/errormessage');
    exit;
}



if (isset($_POST['edit'])) {
    $id = $_POST['inputId'];
    $name = $_POST['inputName'];
    $address = $_POST['inputAddress'];
    $email = $_POST['inputEmail'];
    $phone = $_POST['inputPhoneNumber'];
    $latitude = $_POST['inputLatitude'];
    $longitude = $_POST['inputLongitude'];
    $openTime = $_POST['inputOpenAndCloseTime'];
    $category = 'test';
    $description = $_POST['inputDescription'];
    AccountController::editAccount(new AccountInfo($id, $email, null, null, null, null));
    ShopInformationController::editShopInformation(new ShopInformation($id, $name, $address, $phone, "", $latitude, $longitude, $openTime, $description, $category));
    ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"edit","account","edit account information [ account id : ".$id." ]",null));
    //uplaod images
    $folderPath = "../user_upload/".$id."/shop_images/";
    $target_dir = $folderPath;

    $target_file = array();
    foreach ($_FILES["files"]["name"] as $aImage) {
        $target_file[] = $target_dir . basename($aImage);
    }

    $i = 0;
    $uploadPath = array();
    foreach ($_FILES["files"]["tmp_name"] as $imageTmp) {
        if (move_uploaded_file($imageTmp, $target_file[$i])) {
            $uploadPath[] = $target_file[$i];
        }
        $i++;
    }
    //add image

    foreach($uploadPath as $image){
        $shopImageController = new ShopImageController();
        $shopImageController->addImage(new ShopImage("",$id,$image,""));
    }
    $_SESSION['manageAccountStatus']= "true";
    $_SESSION['manageAccountAction'] = "edit";
    header('Location: '.Config::PATH.'/accounts');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WAP / Edit account</title>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>
</head>
<body>
<div style="margin: 80px;" class="container-fluid" id="top">
    <div class="row">
        <form role="form" name="inputeditaccount" action="" method="post" enctype="multipart/form-data">
            <h2>Edit account</h2>
            <?php
            $account = AccountController::getAccountById($_GET['userId']);
            $shopInformation = ShopInformationController::getShopInformationById($_GET['userId']);
            ?>
            <input type="hidden" class="form-control" name="inputId" required
                   value="<?php echo $shopInformation->getAccountId(); ?>">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Shop name</label>
                    <input type="text" class="form-control" name="inputName" required
                           value="<?php echo $shopInformation->getName(); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" class="form-control" name="inputEmail" readonly required
                           value="<?php echo($account->getEmail()); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPhoneNumber">Phone number</label>
                    <input type="text" class="form-control " name="inputPhoneNumber" required
                           value="<?php echo $shopInformation->getPhoneNumber(); ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOpenAndCloseTime">Open and Close</label>
                        <input type="text" class="form-control" name="inputOpenAndCloseTime" required
                               value="<?php echo($shopInformation->getOpenTime()); ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" name="inputAddress"
                           value="<?php echo($shopInformation->getAddress()); ?>" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="map">Pin your shop location on the map</label>

                    <div style="width: 100%; height:300px;" id="googleMap"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputLatitude">Latitude</label>
                    <input type="text" class="form-control" id="inputLatitude" name="inputLatitude" required
                           value="<?php echo($shopInformation->getLatitude()); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputLongitude">Longitude</label>
                    <input type="text" class="form-control" id="inputLongitude" name="inputLongitude" required
                           value="<?php echo($shopInformation->getLongitude()); ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>A description for your shop</label>
                    <textarea class="form-control" name="inputDescription" rows="3"
                              required><?php echo($shopInformation->getDescription()); ?></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <label>Current shop images in system</label>
            </div>
            <?php
            $shopImageController = new ShopImageController();
            $shopImageList = $shopImageController->getImageByAccountId($account->getAccountId());
            if ($shopImageList != null) {
                foreach ($shopImageList as $shopImage) {
                    echo('
                            <div id="showImage'.$shopImage->getId().'" style="padding-bottom: 20px;" class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body text-right">
                                        <a href="'.Config::PATH.'/View/take_delete_shop_image.php?shopImageId=' . $shopImage->getId() . '" onclick="return false;" class="deleteImage btn btn-danger btn-sm">remove</a>
                                    </div>
                                    <img width="100%" src="'.Config::PATH.'/whatapro/' . $shopImage->getImagePath() . '">
                                </div>
                            </div>
                        ');
                }
            } else {
                echo ('<img class="col-md-6" width="100%" src="'.Config::PATH.'/img/noimage.png">');
            }
            ?>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputImageLabel">Add more image(s)</label>
                    <input class="form-control" id="files" name="files[]" type="file" multiple/>
                </div>
            </div>

            <div class="col-md-12" id="result"></div>

            <div style="margin-top: 20px;" class="col-md-12">
                <a class="btn btn-default" href="<?php echo Config::PATH.'/accounts'; ?>" role="button">Back</a>
                <button type="submit" name="edit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>
    <!-- /row -->
</div>
<!-- /container -->
<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#top"><strong style="text-decoration: none; color: orangered">Back to top</strong></a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script>

    $(".deleteImage").click(function (e) {
        if (confirm("Do you really want to delete this image?")) {
            e.preventDefault()
            $.get($(this).attr('href'), function (result,data) {
                $('#showImage'+result).remove();
            });
        }
    });

    window.onload = function(){
        //Check File API support
        if(window.File && window.FileList && window.FileReader)
        {
            var filesInput = document.getElementById("files");
            filesInput.addEventListener("change", function(event){
                var files = event.target.files; //FileList object
                var output = document.getElementById("result");
                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];
                    //Only pics
                    if(!file.type.match('image'))
                        continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load",function(event){
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.innerHTML = "<img class='img-rounded img-thumbnail col-sm-3' src='" + picFile.result + "'" +"title='" + picFile.name + "'/>";
                        output.insertBefore(div,null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            });
        }
        else
        {
//            console.log(“Your browser does not support File API”);
        }
    }


    var userLat = <?php echo json_encode($shopInformation->getLatitude()); ?>;
    var userLong = <?php echo json_encode($shopInformation->getLongitude()); ?>;

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