<?php
include_once 'session.php';
if ('admin' == $user_type) {
    $promotionList = PromotionController::getAllPromotion();
    if(isset($_POST['edit'])){
        header("Location: ".Config::PATH."/promotion/edit/".$_POST['promotionId']);
    } else if(isset($_POST['delete'])){
        $promotionId= $_POST['promotionId'];
        $promotionImageController = new PromotionImageController();
        $promotion = PromotionController::getPromotionById($promotionId);
//        delete promotion image
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
        $promotionImageController->deleteImageByPromotionId($promotion->getPromotionId());
        if($promotionImageList != null){
            foreach ($promotionImageList as $promotionImage) {
                unlink($promotionImage->getImagePath());
            }
        }
        rmdir("user_upload/" . $promotion->getAccountId() . "/promotions/" . $promotion->getPromotionId());
//        delete promotion
        $deletePromotion = PromotionController::deletePromotionByPromotionId($promotionId);
        header("Refresh: 0; url=".Config::PATH."/promotions");
    }
}

if('user' == $user_type){
    $promotionList = PromotionController::getPromotionByShopId($logInAccount->getAccountId());
    if(isset($_POST['edit'])){
        header("Location: ".Config::PATH."/promotion/edit/".$_POST['promotionId']);
    }
}

?>
<html>
<head>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>

</head>
<body>
<div style="margin-top: 80px;"></div>

<?php

if (isset($_SESSION['managePromotionStatus']) && isset($_SESSION['managePromotionAction'])) {
    if ($_SESSION['managePromotionStatus'] == true) {
        if ($_SESSION['managePromotionAction'] == "delete") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Deleting promotion <strong>successful!</strong>
                </div>
            ');
        } elseif ($_SESSION['managePromotionAction'] == "add") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Adding promotion <strong>successful!</strong>
                </div>
            ');
        } elseif ($_SESSION['managePromotionAction'] == "edit") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Updating promotion <strong>successful!</strong>
                </div>
            ');
        } else {

        }

    }
    unset($_SESSION['managePromotionStatus']);
    unset($_SESSION['managePromotionAction']);
}

?>

<div class="container-fluid">
    <div class="col-md-12">
        <h2>Promotions</h2>
    </div>
    <form class="col-md-6" action="" style="padding-bottom: 20px;">
        <input type="text" class="form-control" id="inputSearch" onkeyup="searchData(this.value)" placeholder="Search promotion by promotion name, shop name or promotion id">
    </form>
    <div class="col-md-6 text-right">
        <a class="btn btn-default" href="<?php echo Config::PATH.'/' ?>promotion/add" role="button"><span class="glyphicon glyphicon-plus"></span> New promotion</a>
    </div>

        <table class="table table-hover table-condensed">
            <tr id="tableHeader">
                <th>Id</th>
                <th>Promotion name</th>
                <th>Shop name</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            foreach($promotionList as $promotion){
                $promotionImageList = array();
                $promotionImageController = new PromotionImageController();
                $imageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
                if($promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId()) != null){
                    foreach($imageList as $image){
                        $promotionImageList[] = $image->getImagePath();
                    }
                }
                $shopInfo = ShopInformationController::getShopInformationById($promotion->getAccountId());
                Adaptor::setStatus($promotion->getStatus());
                $startDate = new DateTime($promotion->getStartDate());
                $endDate = new DateTime($promotion->getEndDate());
                ;
                echo('<tr class="tableData">
                    <td>'.$promotion->getPromotionId().'</td>
                    <td><a href="'.Config::PATH.'/promotion/'.$promotion->getPromotionId().'">'.$promotion->getName().'</a></td>
                    <td><a href="'.Config::PATH.'/account/'.$shopInfo->getAccountId().'">'.$shopInfo->getName().'</a></td>
                    <td>'.$startDate->format('Y-m-d').'</td>
                    <td>'.$endDate->format('Y-m-d').'</td>
                    <td class="col-md-4">');
                foreach($promotionImageList as $aImage){
                    echo'<img class="col-md-3" src="'. Config::PATH."/whatapro/".$aImage.'">';
                }
                echo ('</td>
                    <td>'.Adaptor::getStatus().'</td>
                    <td>
                            <form id="deleteForm" name=promotion action="" method="post">
                                <input type=hidden value=' . $promotion->getPromotionId() . ' name="promotionId" >
                                <button name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button onclick="show_alert(); return false;" name="delete" type=submit><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </td>
                </tr>');
            }
            ?>
        </table>
</div>
<script>
    function show_alert() {
        if (confirm("Do you really want to delete this account?")) {
            document.forms.name("deleteuser").submit();
        }
    }

    function searchData(data) {
        $.ajax({
            method: "GET",
            url: "whatapro/searchpromotion",
            data: { key: data}
        })
            .done(function( msg ) {
                $('.tableData').remove();
                $( "#tableHeader" ).after(msg);
            });
    }
</script>
</body>
</html>
