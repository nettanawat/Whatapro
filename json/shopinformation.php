<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 10:07 PM
 */
include_once '../Config.php';
$shopImageController = new ShopImageController();
$shopInformationList = array();
$promotionList = array();
if(isset($_GET['accountId'])){
    $shopInformationList[] = ShopInformationController::getShopInformationById($_GET['accountId']);
} elseif(isset($_GET['hasPromotion'])){
    $allShopInfo = ShopInformationController::getAllShopInformation();
    for($i=0;$i<sizeof($allShopInfo);$i++) {
        $promotionController = new PromotionController();

        if($promotionController->getPromotionByShopId($allShopInfo[$i]->getAccountId()) != null){
            $shopInformationList[] = $allShopInfo[$i];
            $promotionList = $promotionController->getPromotionByShopId($allShopInfo[$i]->getAccountId());
        }
//        var_dump($promotionController->getPromotionByShopId($allShopInfo[$i]->getAccountId()));

        //image
        $dataImageList = null;
        if($shopImageController->getImageByAccountId($allShopInfo[$i]->getAccountId()) != null){
            $dataImageList = $shopImageController->getImageByAccountId($allShopInfo[$i]->getAccountId());
        }
    }

} elseif(isset($_GET['latitude']) && isset($_GET['longitude'])){
    $shopInformationList[] = ShopInformationController::getShopInformationByLatitudeAndLongitude($_GET['latitude'], $_GET['longitude']);

} elseif(isset($_GET[''])){

}
elseif(isset($_GET[''])){

} else {
    $shopInformationList = ShopInformationController::getAllShopInformation();

}
//crate JSON form

$outputarr['response_message'] = "success";
$outputarr['response_status'] = true;
$outputarr['response_rows'] = sizeof($shopInformationList);
$outputarr['response_data'] = array();
for($i=0;$i<sizeof($shopInformationList);$i++) {
    $dataImageList = null;
    if($shopImageController->getImageByAccountId($shopInformationList[$i]->getAccountId()) != null){
        $dataImageList = $shopImageController->getImageByAccountId($shopInformationList[$i]->getAccountId());
    }
    $outputarr['response_data'][$i] = array();
    $outputarr['response_data'][$i]['account_id'] = $shopInformationList[$i]->getAccountId();
    $outputarr['response_data'][$i]['name'] = $shopInformationList[$i]->getName();
    $outputarr['response_data'][$i]['address'] = $shopInformationList[$i]->getAddress();
    $outputarr['response_data'][$i]['phone_number'] = $shopInformationList[$i]->getPhoneNumber();
    $outputarr['response_data'][$i]['sub_district'] = $shopInformationList[$i]->getSubDistrict();
    $outputarr['response_data'][$i]['latitude'] = $shopInformationList[$i]->getLatitude();
    $outputarr['response_data'][$i]['longitude'] = $shopInformationList[$i]->getLongitude();
    $outputarr['response_data'][$i]['open_time'] = $shopInformationList[$i]->getOpenTime();
    $outputarr['response_data'][$i]['description'] = $shopInformationList[$i]->getDescription();
    if($dataImageList != null){
        $imageout['image'] = array();
        for($j=0; $j<sizeof($dataImageList);$j++ ){
            $imageout['image'][$j]['image'.($j+1)] = $dataImageList[$j]->getImagePath();
        }
        $outputarr['response_data'][$i]['shop_image'] = $imageout['image'];
    }
    if($promotionList != null){
        $promotionout['promotion'] = array();
        for($j=0; $j<sizeof($promotionList);$j++ ){
            $promotionout['promotion'][$j]['promotion_id'] = $promotionList[$j]->getPromotionId();
            $promotionout['promotion'][$j]['promotion_name'] = $promotionList[$j]->getName();
        }
        $outputarr['response_data'][$i]['shop_promotion'] = $promotionout['promotion'];
    }
}
echo json_encode($outputarr);
