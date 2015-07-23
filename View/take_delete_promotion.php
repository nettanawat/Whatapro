<?php
include dirname(__FILE__) . '/../Config.php';


$promotionId = $_POST['promotionId'];
$promotionImageController = new PromotionImageController();
$promotion = PromotionController::getPromotionById($promotionId);

//        delete promotion image
$deleteImage = 1;
$promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
if ($promotionImageList != null) {
    $deleteImage = $promotionImageController->deleteImageByPromotionId($promotion->getPromotionId());
    foreach ($promotionImageList as $promotionImage) {
        unlink("../".$promotionImage->getImagePath());
    }
}
$deletePath = "../user_upload/" . $promotion->getAccountId() . "/promotions/" . $promotion->getPromotionId();
rmdir($deletePath);


//        delete promotion
$deletePromotion = PromotionController::deletePromotionByPromotionId($promotionId);
echo ($promotionId);