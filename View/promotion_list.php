<?php
include_once 'session.php';
if ('admin' == $user_type) {
    $promotionList = PromotionController::getAllPromotion();

}

if('user' == $user_type){
    $promotionList = PromotionController::getPromotionByShopId($logInAccount->getAccountId());
    if(isset($_POST['edit'])){
        header("Location: edit_promotion.php?promotionId=".$_POST['promotionId']);
    }
}

?>
<html>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div style="margin-top: 80px;"></div>
<div class="container-fluid">
    <h2 class="col-md-11">Promotions</h2>
    <a class="btn btn-default col-md-1" href="add_promotion.php" role="button">New promotion</a>
        <table class="table table-hover table-condensed">
            <tr>
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
                echo('<tr>
                    <td>'.$promotion->getPromotionId().'</td>
                    <td>'.$promotion->getName().'</td>
                    <td><a href="edit_account.php?userId='.$shopInfo->getAccountId().'">'.$shopInfo->getName().'</a></td>
                    <td>'.$promotion->getStartDate().'</td>
                    <td>'.$promotion->getEndDate().'</td>
                    <td class="col-md-4">');
                foreach($promotionImageList as $aImage){
                    echo'<img class="col-md-3" src="'.$aImage.'">';
                }
                echo ('</td>
                    <td>'.Adaptor::getStatus().'</td>
                    <td>
                            <form name=deleteuser action=""method="post">
                                <input type=hidden value=' . $promotion->getPromotionId() . ' name="promotionId" >
                                <button name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button name="delete" type=submit><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </td>
                </tr>');
            }

            ?>
        </table>
</div>
</body>
</html>
