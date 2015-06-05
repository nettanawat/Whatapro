<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 10:07 PM
 */
include_once '../Config.php';

$datalist = ShopInformationController::getAllShopInformation();
$shopImageController = new ShopImageController();
$outputarr['response_message'] = "success";
$outputarr['response_status'] = true;
$outputarr['response_rows'] = sizeof($datalist);
$outputarr['response_data'] = array();
for($i=0;$i<sizeof($datalist);$i++) {
    $dataImageList = $shopImageController->getImageByAccountId($datalist[$i]->getAccountId());
    $outputarr['response_data'][$i] = array();
    $outputarr['response_data'][$i]['account_id'] = $datalist[$i]->getAccountId();
    $outputarr['response_data'][$i]['name'] = $datalist[$i]->getName();
    $outputarr['response_data'][$i]['address'] = $datalist[$i]->getAddress();
    $outputarr['response_data'][$i]['phone_number'] = $datalist[$i]->getPhoneNumber();
    $outputarr['response_data'][$i]['sub_district'] = $datalist[$i]->getSubDistrict();
    $outputarr['response_data'][$i]['latitude'] = $datalist[$i]->getLatitude();
    $outputarr['response_data'][$i]['longitude'] = $datalist[$i]->getLongitude();
    $outputarr['response_data'][$i]['open_time'] = $datalist[$i]->getOpenTime();
    $outputarr['response_data'][$i]['description'] = $datalist[$i]->getDescription();
    $imageout['image'] = array();
    for($j=0; $j<sizeof($dataImageList);$j++ ){
        $imageout['image'][$j]['image'.($j+1)] = $dataImageList[$j]->getImagePath();
    }
    $outputarr['response_data'][$i]['shop_image'] = $imageout['image'];
}
echo json_encode($outputarr);
