<?php
include_once 'session.php';
if ('admin' == $user_type) {
    $promotionList = PromotionController::getAllPromotion();
    if (isset($_POST['edit'])) {
        header("Location: " . Config::PATH . "/promotion/edit/" . $_POST['promotionId']);
    }
}

if ('user' == $user_type) {
    $promotionList = PromotionController::getPromotionByShopId($logInAccount->getAccountId());
    if (isset($_POST['edit'])) {
        header("Location: " . Config::PATH . "/promotion/edit/" . $_POST['promotionId']);
    }
}

?>
<html>
<head>
    <?php

    $assetPath = Config::PATH . '';

    include_once '../assets.php'

    ?>

</head>
<body>
<div style="margin-top: 50px;">

</div>

<?php

if (isset($_SESSION['managePromotionStatus']) && isset($_SESSION['managePromotionAction'])) {
    if ($_SESSION['managePromotionStatus'] == true) {
        if ($_SESSION['managePromotionAction'] == "add") {
            echo '<input type="hidden" value="add" id="hiddenSession"';
        } elseif ($_SESSION['managePromotionAction'] == "edit") {
            echo '<input type="hidden" value="edit" id="hiddenSession"';
        } else {

        }

    }
    unset($_SESSION['managePromotionStatus']);
    unset($_SESSION['managePromotionAction']);
}

?>

<div class="container-fluid">
    <div style="display: none;" id="updatesuccess" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Updating promotion <strong>successful!</strong></div>
    <div style="display: none;" id="addsuccess" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Adding promotion <strong>successful!</strong></div>
    <div  id="top" class="col-md-12">
        <h2>Promotions</h2>
    </div>
    <?php if ('admin' == $user_type) {

        echo '<form class="col-md-6" action="" style="padding-bottom: 20px;">
        <input type="text" class="form-control" id="inputSearch" onkeyup="searchData(this.value)" placeholder="Search promotion by promotion name, shop name or promotion id">
    </form>
    <div class="col-md-6 text-right">
        <a class="btn btn-default" href="'.Config::PATH.'/promotion/add" role="button"><span class="glyphicon glyphicon-plus"></span> New promotion</a>
    </div>';
} elseif('user' == $user_type){
        echo '<div style="margin-bottom: 20px;" class="col-md-12 text-right">
        <a class="btn btn-default" href="'.Config::PATH.'/promotion/add" role="button"><span class="glyphicon glyphicon-plus"></span> New promotion</a>
    </div>';
    } ?>


    <table class="col-md-12 table table-hover table-condensed">
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
        foreach ($promotionList as $promotion) {
            $promotionImageList = array();
            $promotionImageController = new PromotionImageController();
            $imageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
            if ($promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId()) != null) {
                foreach ($imageList as $image) {
                    $promotionImageList[] = $image->getImagePath();
                }
            }
            $shopInfo = ShopInformationController::getShopInformationById($promotion->getAccountId());
            Adaptor::setStatus($promotion->getStatus());
            $startDate = new DateTime($promotion->getStartDate());
            $endDate = new DateTime($promotion->getEndDate());;
            echo('<tr class="tableData" id="showData'.$promotion->getPromotionId().'">
                    <td>' . $promotion->getPromotionId() . '</td>
                    <td><a href="' . Config::PATH . '/promotion/' . $promotion->getPromotionId() . '">' . $promotion->getName() . '</a></td>
                    <td><a href="' . Config::PATH . '/account/' . $shopInfo->getAccountId() . '">' . $shopInfo->getName() . '</a></td>
                    <td>' . $startDate->format('Y-m-d') . '</td>
                    <td>' . $endDate->format('Y-m-d') . '</td>
                    <td class="col-md-4">');
            foreach ($promotionImageList as $aImage) {
                echo '<img class="col-md-3" src="' . Config::PATH . "/" . $aImage . '">';
            }
            echo('</td>
                    <td>' . Adaptor::getStatus() . '</td>
                    <td>
                        <button class="editBtn" id='.Config::PATH . "/promotion/edit/" . $promotion->getPromotionId() .' name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                        <button class="deleteBtn" id="'. $promotion->getPromotionId() .'" name="delete" type="button"><span class="glyphicon glyphicon-remove-circle"></span></button>
                    </td>
                </tr>');
        }
        ?>
    </table>
</div>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script>

    $("button.editBtn").click(function(e){
        $(location).attr('href', this.id);
    });

    $(document).ready(function () {
        var sessionAction = $("#hiddenSession").val();
        if(sessionAction == "add") {
            $("#addsuccess").show().delay(3000).fadeOut();
        } else if(sessionAction == "edit") {
            $("#updatesuccess").show().delay(3000).fadeOut();
        } else if(sessionAction == "none") {
        }
    });

    $("button.deleteBtn").click(function(e) {
        e.preventDefault();
        var promotionId = this.id;
        if (confirm("Do you really want to delete this promotion?")) {
            $.ajax({
                method: "POST",
                url: "whatapro/view/take_delete_promotion.php",
                data: { promotionId: promotionId}
            })
                .done(function (deleteId) {
                    $('#showData' + deleteId).remove();
                    var showMessageString = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Deleting promotion <strong>successful!</strong></div>';
                    $(showMessageString).insertBefore('#top').delay(3000).fadeOut();
                });
        }
    });

    function searchData(data) {
        $.ajax({
            method: "GET",
            url: "whatapro/searchpromotion",
            data: { key: data}
        })
            .done(function (msg) {
                $('.tableData').remove();
                $("#tableHeader").after(msg);
            });
    }
</script>

</body>
</html>
