<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 10:07 PM
 */
require_once '../entity/ShopInformationDAOImpl.php';

$shopInformation = new ShopInformationDAOImpl();
$datalist = $shopInformation->getAllShopInformation();

$outputarr['response_message'] = "success";
$outputarr['response_status'] = true;
$outputarr['response_rows'] = sizeof($datalist);
$outputarr['response_data'] = array();
for($i=0;$i<sizeof($datalist);$i++) {
    $outputarr['response_data'][$i] = array();
    $outputarr['response_data'][$i]['id'] = $datalist[$i]->getId();
    $outputarr['response_data'][$i]['account_id'] = $datalist[$i]->getAccountId();
    $outputarr['response_data'][$i]['phone_number'] = $datalist[$i]->getPhoneNumber();
    $outputarr['response_data'][$i]['sub_district'] = $datalist[$i]->getSubDistrict();
    $outputarr['response_data'][$i]['latitude'] = $datalist[$i]->getLatitude();
    $outputarr['response_data'][$i]['longitude'] = $datalist[$i]->getLongitude();
    $outputarr['response_data'][$i]['open_time'] = $datalist[$i]->getOpenTime();
    $outputarr['response_data'][$i]['description'] = $datalist[$i]->getDescription();
    $outputarr['response_data'][$i]['image'] = $datalist[$i]->getImage();
}
echo json_encode($outputarr);