<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/7/15 AD
 * Time: 6:48 PM
 */
include_once '../Config.php';
$promotionList = PromotionController::getAllPromotion();
$promotionImageController = new PromotionImageController();
for($i=0;$i<sizeof($promotionList);$i++) {
    $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotionList[$i]->getPromotionId());
    $outputarr['response_data'][$i]['promotion_id'] = $promotionList[$i]->getPromotionId();
    $outputarr['response_data'][$i]['account_id'] = $promotionList[$i]->getAccountId();
}
echo json_encode($outputarr);