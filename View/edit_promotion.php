<?php
include_once 'session.php';
if (isset($_POST['inputAccountId']) && isset($_POST['inputPromotionId']) && isset($_POST['inputName'])) {
    $id = $_POST['inputAccountId'];
    $promotionId = $_POST['inputPromotionId'];
    $name = $_POST['inputName'];
    $startDate = $_POST['inputStartDate'];
    $endDate = $_POST['inputEndDate'];
    $description = $_POST['inputDescription'];
    $editPromotion = PromotionController::editPromotion(new Promotion($promotionId, $id, $name, $description, 0, $startDate, $endDate, 1));
    ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"edit","promotion","edit promotion information [ promotion id : ".$promotionId." ]",null));
//uplaod images
    $folderPath = "user_upload/" . $id . "/promotions/" . $promotionId . "/";
    $target_dir = $folderPath;

    if(isset($_FILES)) {
        $target_file = array();
        $realPath = array();
        $i=0;
        foreach ($_FILES["files"]["name"] as $aImage) {
            $realPath[] = $target_dir . basename($aImage);
            $target_file[] = "../".$realPath[$i];
            $i++;
        }

        $i = 0;
        $uploadPath = array();
        foreach ($_FILES["files"]["tmp_name"] as $imageTmp) {
            if (move_uploaded_file($imageTmp, $target_file[$i])) {
                $uploadPath[] = $realPath[$i];
            }
            $i++;
        }
        //add image

        foreach ($uploadPath as $image) {
            $promotionImageController = new PromotionImageController();
            $promotionImageController->addImage(new PromotionImage("", $promotionId, $image, ""));
        }
    }
    if($editPromotion == 1){
        $_SESSION['managePromotionStatus'] = "true";
        $_SESSION['managePromotionAction'] = "edit";
    } else {
        $_SESSION['managePromotionStatus'] = "false";
        $_SESSION['managePromotionAction'] = "edit";
    }
    header('Location: ' . Config::PATH . '/promotions');
    exit;
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>WAP / Add Promotion</title>
    <?php

    $assetPath = Config::PATH . '';

    include_once '../assets.php'

    ?>
</head>
<body>
<div style="margin: 80px;" class="container-fluid">
    <div class="row">
        <?php

        $promotion = PromotionController::getPromotionById($_GET['promotionId']);
        $promotionImageController = new PromotionImageController();
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
        $startDate = new DateTime($promotion->getStartDate());
        $endDate = new DateTime($promotion->getEndDate());
        ?>
        <form name="addPromotionForm" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="inputAccountId" value="<?php echo $promotion->getAccountId(); ?>">
            <input type="hidden" name="inputPromotionId" value="<?php echo $promotion->getPromotionId(); ?>">

            <div class="col-md-12">
                <label class="titleFontSize">Edit promotion</label>
            </div>
            <div class="col-md-6">
                <div class="form-group promotionName">
                    <label class="control-label" for="inputName">Promotion name</label>
                    <input type="text" class="form-control" value="<?php echo $promotion->getName(); ?>"
                           name="inputName" placeholder="Buy 1 get 1 free" required id="promotionName">
                </div>
            </div>

            <div id="sDateDiv" class="col-md-6">
                <div class="form-group dateClass">
                    <label class="control-label" for="inputStartDate">Start date</label>
                    <input id="startDateId" type="date" class="form-control" name="inputStartDate" value="<?php echo $startDate->format('Y-m-d'); ?>" required>
                </div>
            </div>
            <div id="eDateDiv" class="col-md-6">
                <div class="form-group dateClass">
                    <label class="control-label" for="inputEndDate">End date</label>
                    <input id="endDateId" type="date" class="form-control" name="inputEndDate" value="<?php echo $endDate->format('Y-m-d'); ?>" required">
                </div>
            </div>
            <div id="selectImageDiv" class="col-md-6">
                <div class="form-group">
                    <label for="files">Select image(s)</label>
                    <input class="form-control" id="files" name="files[]" type="file" multiple/>
                </div>
            </div>
            <div class="col-md-12" id="result"></div>
            <div class="col-md-12">
                <div class="form-group description">
                    <label class="control-label">Description</label>
                    <textarea id="description" class="form-control" name="inputDescription" rows="3" required placeholder="Something describe about your promotion"><?php echo $promotion->getDescription(); ?></textarea>
                </div>
            </div>
            <?php
            if ($promotionImageList != null) {
                foreach ($promotionImageList as $promotionImage) {
                    echo('
                            <div id="showImage' . $promotionImage->getId() . '" style="padding-bottom: 20px;" class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body text-right">
                                        <a href="' . Config::PATH . '/View/take_delete_promotion_image.php?promotionImageId=' . $promotionImage->getId() . '" class="deleteImage btn btn-danger btn-sm">remove</a>
                                    </div>
                                    <img width="100%" src="' . Config::PATH . '/' . $promotionImage->getImagePath() . '">
                                </div>
                            </div>
                        ');
                }
            } else {
                echo('<img id="noImage" class="col-md-6" width="100%" src="' . Config::PATH . '/img/noimage.png">');
            }
            ?>
            <div class="col-md-12" id="result"></div>
            <div style="padding-top: 30px;" class="col-md-12">
                <input id="clickSubmit" type="submit" value="Submit" name="edit" class="btn btn-default"/>
            </div>
        </form>
        <!-- /row -->
    </div>
</div>
<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo Config::PATH . '/promotions'; ?>"><strong
                        style="text-decoration: none; color: orangered">Back</strong></a></li>
        </ul>
    </div>
</nav>

<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="Whatapro/promotionvalidation.js"></script>
<script>
    $(".deleteImage").click(function (e) {
        if (confirm("Do you really want to delete this image?")) {
            e.preventDefault()
            $.get($(this).attr('href'), function (result, data) {
                $('#showImage' + result).remove();
            });
        }
    });

    window.onload = function () {
        //Check File API support
        if (window.File && window.FileList && window.FileReader) {
            var filesInput = document.getElementById("files");
            filesInput.addEventListener("change", function (event) {
                var files = event.target.files; //FileList object
                var output = document.getElementById("result");
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Only pics
                    if (!file.type.match('image'))
                        continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.innerHTML = "<img class='img-rounded img-thumbnail col-sm-3' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                        output.insertBefore(div, null);
                    });
                    $("#noImage").remove();
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            });
        }
        else {
//            console.log(“Your browser does not support File API”);
        }
    }

</script>
</body>
</html>