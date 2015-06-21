<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 8:09 PM
 */
include_once '../Config.php';



if(isset($_GET['promotionId'])){
    $promotion = PromotionController::getPromotionByShopId($_GET['promotionId']);
    $promotionImageController = new PromotionImageController();
    $outputarr['response_message'] = "success";
    $outputarr['response_status'] = true;
    $outputarr['response_rows'] = sizeof($datalist);
    $outputarr['response_data'] = array();
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
        $outputarr['response_data'] = array();
        $outputarr['response_data']['promotion_id'] = $promotion->getPromotionId();
        $outputarr['response_data']['account_id'] = $promotion->getAccountId();
        $outputarr['response_data']['description'] = $promotion->getDescription();
        $imageout['image'] = array();
        for($j=0; $j<sizeof($promotionImageList);$j++ ){
            $imageout['image'][$j]['image'.($j+1)] = $promotion->getImagePath();
        }
        $outputarr['response_data']['promotion_image'] = $imageout['image'];
        $outputarr['response_data']['shared'] = $promotion->getShared();
        $outputarr['response_data']['start_date'] = $promotion->getStartDate();
        $outputarr['response_data']['end_date'] = $promotion->getEndDate();
        $outputarr['response_data']['status'] = $promotion->getStatus();
    echo json_encode($outputarr);
} elseif(isset($_GET[''])){

} elseif(isset($_GET[''])){

} elseif(isset($_GET[''])){

}
elseif(isset($_GET[''])){

} else {
    $promotionList = PromotionController::getAllPromotion();
    $promotionImageController = new PromotionImageController();
    $outputarr['response_message'] = "success";
    $outputarr['response_status'] = true;
    $outputarr['response_rows'] = sizeof($promotionList);
    $outputarr['response_data'] = array();
    for($i=0;$i<sizeof($promotionList);$i++) {
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotionList[$i]->getPromotionId());
        $outputarr['response_data'][$i] = array();
        $outputarr['response_data'][$i]['promotion_id'] = $promotionList[$i]->getPromotionId();
        $outputarr['response_data'][$i]['account_id'] = $promotionList[$i]->getAccountId();
        $outputarr['response_data'][$i]['description'] = $promotionList[$i]->getDescription();
        $imageout['image'] = array();
        for($j=0; $j<sizeof($promotionImageList);$j++ ){
            $imageout['image'][$j]['image'.($j+1)] = $promotionImageList[$j]->getImagePath();
        }
        $outputarr['response_data'][$i]['promotion_image'] = $imageout['image'];
        $outputarr['response_data'][$i]['shared'] = $promotionList[$i]->getShared();
        $outputarr['response_data'][$i]['start_date'] = $promotionList[$i]->getStartDate();
        $outputarr['response_data'][$i]['end_date'] = $promotionList[$i]->getEndDate();
        $outputarr['response_data'][$i]['status'] = $promotionList[$i]->getStatus();
    }
    echo json_encode($outputarr);
}
