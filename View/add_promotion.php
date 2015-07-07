<?php
    include_once 'session.php';
    if(isset($_POST['add'])){

        if('user' == $user_type){
            $promotionId = PromotionController::addPromotion(new Promotion("", $logInAccount->getAccountId(), $_POST['inputName'], $_POST['inputDescription'],"",$_POST['inputStartDate'],$_POST['inputEndDate'], 1));
            ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"add","promotion","add promotion into database [ promotion id : ".$promotionId." ]",null));

            //uplaod images
            $accountId = $logInAccount->getAccountId();
            $old = umask(0);
            $folderPath = "../user_upload/".$accountId."/promotions/".$promotionId."/";
            mkdir($folderPath, 0777,true);
            $target_dir = $folderPath;
            umask($old);
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
                $promotionImageController = new PromotionImageController();
                $promotionImageController->addImage(new PromotionImage("", $promotionId, $image,""));
            }
        }


        if('admin' == $user_type){
            $promotionId = PromotionController::addPromotion(new Promotion("", $_POST['selectedShopId'], $_POST['inputName'], $_POST['inputDescription'],"",$_POST['inputStartDate'],$_POST['inputEndDate'], 1));
            ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"add","promotion","add promotion into database [ promotion id : ".$promotionId." ]",null));
            //uplaod images
            $accountId = $_POST['selectedShopId'];
            $old = umask(0);
            $folderPath = "../user_upload/".$accountId."/promotions/".$promotionId."/";
            mkdir($folderPath, 0777,true);
            $target_dir = $folderPath;
            umask($old);
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
                $promotionImageController = new PromotionImageController();
                $promotionImageController->addImage(new PromotionImage("", $promotionId, $image,""));
            }

        }
        $_SESSION['managePromotionStatus']= "true";
        $_SESSION['managePromotionAction'] = "add";
        header('Location: '.Config::PATH.'/promotions');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>WAP / Add Promotion</title>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php';
    ?>
<!--    <script src="../lightbox.js"></script>-->
</head>
<body>
<div style="margin: 80px;" class="container-fluid">
    <div class="row">
        <form id="addPromotionForm" action="" method="post" enctype="multipart/form-data">

            <div class="col-md-12">
                <label class="titleFontSize">New promotion</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Promotion name</label>
                    <input type="text" class="form-control" name="inputName" placeholder="Buy 1 get 1 free" required>
                </div>
            </div>
            <?php
            if('admin'== $user_type) {
                echo'
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputEmail">Select shop</label>
                            <div class="form-group">
                                <button id="clickSelectShop" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Select Shop</button>
                                <label id="show"></label>
                                <input type="hidden" id="selectedShopId" name="selectedShopId">
                            </div>
                        </div>
                    </div>';
            }
            ?>
            <div id="sDateDiv" class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="inputStartDate">Start date</label>
                    <input id="startDateId" type="date" class="form-control" name="inputStartDate" required>
                </div>
            </div>
            <div id="eDateDiv" class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="inputEndDate">End date</label>
                    <input id="endDateId" type="date" class="form-control" name="inputEndDate" required">
                </div>
            </div>
            <div id="selectImageDiv" class="col-md-6">
                <div class="form-group">
                    <label for="files">Select image(s)</label>
                    <input class="form-control" id="files" name="files[]" type="file" multiple/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="inputDescription" rows="3" required placeholder="Something describe about your promotion"></textarea>
                </div>
            </div>
            <div class="col-md-12" id="result"></div>
            <div class="col-md-12">
                <a class="btn btn-default" href="account_list.php" role="button">Back</a>
                <button type="submit" id="clickSubmit" name="add" class="btn btn-default">Submit</button>
            </div>
        </form>
        <!-- /row -->
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Shop list</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-condensed">
                    <tr>
                        <th>Shop name</th>
                        <th>Shop address</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $shopList = ShopInformationController::getAllShopInformation();
                    foreach ($shopList as $shop) {
                        echo('
                <tr>
                    <td>' . $shop->getName() . '</td>
                    <td>' . $shop->getAddress() . '</td>
                    <td id="wth"><input type="hidden" id="' . $shop->getAccountId() . '" value="' . $shop->getName() . '"><button id="' . $shop->getAccountId() . '" data-dismiss="modal" class="btn btn-default">Select</button></td>
                </tr>');
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

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
    $(document).ready(function () {
        $("button").click(function(e) {
            if(this.id == "clickSelectShop"){

            }
            else if(this.id == "clickSubmit") {
                var startDate = document.getElementById("startDateId").value;
                var endDate = document.getElementById("endDateId").value;
                if(startDate > endDate) {
                    e.preventDefault();
                    $( "#sDateDiv" ).addClass("has-error");
                    $( "#eDateDiv" ).addClass("has-error");
                    $( "#selectImageDiv" ).before( "<p style='font-size: 18; color: #eb3624' class='col-md-12 has-error'>Waring: Start date must lower than end date</p>" );
                } else {
                    $("form").submit(function(){

                    });
                }
            }
            else {
                $.get('whatapro/View/find_shop_name.php?shopId='+this.id, function (result,data) {
                    document.getElementById("show").innerHTML = "You selected "+result;
                });
                document.getElementById("selectedShopId").value = this.id;
            }
        });
    });


</script>
</body>
</html>