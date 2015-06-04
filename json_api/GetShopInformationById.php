<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 9:24 PM
 */
require_once '../entity/ShopInformationDAOImpl.php';
$shopInformation = new ShopInformationDAOImpl();
$datalist = $shopInformation->getShopInformationById($_GET['id']);
if($datalist!=null)
{
    $outputarr['response_message'] = "success";
    $outputarr['response_status'] = true;
    $outputarr['response_rows'] = 1;
    $outputarr['response_data'] = array();
    $outputarr['response_data']['id'] = $datalist->getId();
    $outputarr['response_data']['account_id'] = $datalist->getAccountId();
    $outputarr['response_data']['phone_number'] = $datalist->getPhoneNumber();
    $outputarr['response_data']['sub_district'] = $datalist->getSubDistrict();
    $outputarr['response_data']['latitude'] = $datalist->getLatitude();
    $outputarr['response_data']['longitude'] = $datalist->getLongitude();
    $outputarr['response_data']['open_time'] = $datalist->getOpenTime();
    $outputarr['response_data']['description'] = $datalist->getDescription();
    $outputarr['response_data']['image'] = $datalist->getImage();
} else {
    $outputarr['response_message'] = "no data";
    $outputarr['response_status'] = false;
    $outputarr['response_rows'] = 0;
    $outputarr['response_data'] = null;
}
echo json_encode($outputarr);