<?php
include_once 'session.php';
if (isset($_POST['edit'])) {
    $id = $_POST['inputAccountId'];
    $promotionId = $_POST['inputPromotionId'];
    $name = $_POST['inputName'];
    $startDate = $_POST['inputStartDate'];
    $endDate = $_POST['inputEndDate'];
    $description = $_POST['inputDescription'];
    PromotionController::editPromotion(new Promotion($promotionId, $id, $name, $description, 0, $startDate, $endDate, 1));
    ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"edit","promotion","edit promotion information [ promotion id : ".$promotionId." ]",null));
//uplaod images
    $folderPath = "../user_upload/" . $id . "/promotions/" . $promotionId . "/";
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

    foreach ($uploadPath as $image) {
        $promotionImageController = new PromotionImageController();
        $promotionImageController->addImage(new PromotionImage("", $promotionId, $image, ""));
    }
    $_SESSION['managePromotionStatus'] = "true";
    $_SESSION['managePromotionStatus'] = "edit";
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
        <form name="inputeditaccount" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="inputAccountId" value="<?php echo $promotion->getAccountId(); ?>">
            <input type="hidden" name="inputPromotionId" value="<?php echo $promotion->getPromotionId(); ?>">

            <div class="col-md-12">
                <label class="titleFontSize">Edit promotion</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Promotion name</label>
                    <input type="text" class="form-control" value="<?php echo $promotion->getName(); ?>"
                           name="inputName" placeholder="Buy 1 get 1 free" required>
                </div>
            </div>
            <div id="sDateDiv" class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="inputStartDate">Start date</label>
                    <input id="startDateId" type="date" value="<?php echo $startDate->format('Y-m-d'); ?>"
                           class="form-control" name="inputStartDate" required>
                </div>
            </div>
            <div id="eDateDiv" class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="inputEndDate">End date</label>
                    <input id="endDateId" type="date" value="<?php echo $endDate->format('Y-m-d'); ?>"
                           class="form-control" name="inputEndDate" required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="files">Select image(s)</label>
                    <input class="form-control" id="files" name="files[]" type="file" multiple/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="inputDescription" rows="3" required
                              placeholder="Something describe about your promotion"><?php echo $promotion->getDescription(); ?></textarea>
                </div>
            </div>
            <?php
            if ($promotionImageList != null) {
                foreach ($promotionImageList as $promotionImage) {
                    echo('
                            <div id="showImage' . $promotionImage->getId() . '" style="padding-bottom: 20px;" class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body text-right">
                                        <a href="' . Config::PATH . '/View/take_delete_promotion_image.php?promotionImageId=' . $promotionImage->getId() . '" onclick="return false;" class="deleteImage btn btn-danger btn-sm">remove</a>
                                    </div>
                                    <img width="100%" src="' . Config::PATH . '/whatapro/' . $promotionImage->getImagePath() . '">
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
<script type="text/javascript">
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
<script>
    $(".deleteImage").click(function (e) {
        if (confirm("Do you really want to delete this image?")) {
            e.preventDefault()
            $.get($(this).attr('href'), function (result, data) {
                $('#showImage' + result).remove();
            });
        }
    });


    $(".clickSubmit").click(function (e) {
        e.preventDefault();
        var startDate = document.getElementById("startDateId").value;
        var endDate = document.getElementById("endDateId").value;
        if (startDate > endDate) {
            $("#sDateDiv").addClass("has-error");
            $("#eDateDiv").addClass("has-error");
            $("#selectImageDiv").before("<p style='font-size: 18; color: #eb3624' class='col-md-12 has-error'>Waring: Start date must lower than end date</p>");
        } else {
            document.forms.name("addPromotionForm").submit();
        }
    });

</script>
</body>
</html>