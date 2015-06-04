<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 9:24 PM
 */
require_once '../entity/PromotionDAOImpl.php';
$promotoinDAOImpl = new PromotionDAOImpl();
$datalist = $promotoinDAOImpl->getPromotionById($_GET['id']);

if($datalist!=null)
{
    $outputarr['response_message'] = "success";
    $outputarr['response_status'] = true;
    $outputarr['response_rows'] = 1;
    $outputarr['response_data'] = array();
    $outputarr['response_data']['promotion_id'] = $datalist->getPromotionId();
    $outputarr['response_data']['account_id'] = $datalist->getAccountId();
    $outputarr['response_data']['description'] = $datalist->getDescription();
    $outputarr['response_data']['img'] = $datalist->getImg();
    $outputarr['response_data']['shared'] = $datalist->getShared();
    $outputarr['response_data']['start_date'] = $datalist->getStartDate();
    $outputarr['response_data']['end_date'] = $datalist->getEndDate();
    $outputarr['response_data']['status'] = $datalist->getStatus();

}
else
{
    $outputarr['response_message'] = "no data";
    $outputarr['response_status'] = false;
    $outputarr['response_rows'] = 0;
    $outputarr['response_data'] = null;
}

echo json_encode($outputarr);
