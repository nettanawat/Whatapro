<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 8:09 PM
 */
include_once '../Config.php';

$promotionImageController = new PromotionImageController();
$promotionList = array();
if(isset($_GET['promotionId'])){
    $promotionList[] = PromotionController::getPromotionByShopId($_GET['promotionId']);
} elseif(isset($_GET[''])){

} elseif(isset($_GET[''])){

} elseif(isset($_GET[''])){

}
elseif(isset($_GET[''])){

} else {
    $promotionList = PromotionController::getAllPromotion();
}

$outputarr['response_message'] = "success";
$outputarr['response_status'] = true;
$outputarr['response_rows'] = sizeof($promotionList);
$outputarr['response_data'] = array();
for($i=0;$i<sizeof($promotionList);$i++) {
    $promotionImageList = null;
    if($promotionImageController->getPromotionImageByPromotionId($promotionList[$i]->getPromotionId())!= null) {
        $promotionImageController = new PromotionImageController();
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotionList[$i]->getPromotionId());
    }
    $outputarr['response_data'][$i] = array();
    $outputarr['response_data'][$i]['promotion_id'] = $promotionList[$i]->getPromotionId();
    $outputarr['response_data'][$i]['account_id'] = $promotionList[$i]->getAccountId();
    $outputarr['response_data'][$i]['description'] = $promotionList[$i]->getDescription();
    if($promotionImageList != null){
        $imageout['image'] = array();
        for($j=0; $j<sizeof($promotionImageList);$j++ ){
            $imageout['image'][$j]['image'.($j+1)] = $promotionImageList[$j]->getImagePath();
        }
        $outputarr['response_data'][$i]['promotion_image'] = $imageout['image'];
    }
    $outputarr['response_data'][$i]['shared'] = $promotionList[$i]->getShared();
    $outputarr['response_data'][$i]['start_date'] = $promotionList[$i]->getStartDate();
    $outputarr['response_data'][$i]['end_date'] = $promotionList[$i]->getEndDate();
    $outputarr['response_data'][$i]['status'] = $promotionList[$i]->getStatus();
}
echo json_encode($outputarr);
