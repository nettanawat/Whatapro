<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 8:09 PM
 */
require_once '../entity/PromotionDAOImpl.php';

$promotoinDAOImpl = new PromotionDAOImpl();
$datalist = $promotoinDAOImpl->getAllPromotions();

$outputarr['response_message'] = "success";
$outputarr['response_status'] = true;
$outputarr['response_rows'] = sizeof($datalist);
$outputarr['response_data'] = array();
for($i=0;$i<sizeof($datalist);$i++) {
    $outputarr['response_data'][$i] = array();
    $outputarr['response_data'][$i]['promotion_id'] = $datalist[$i]->getPromotionId();
    $outputarr['response_data'][$i]['account_id'] = $datalist[$i]->getAccountId();
    $outputarr['response_data'][$i]['description'] = $datalist[$i]->getDescription();
    $outputarr['response_data'][$i]['img'] = $datalist[$i]->getImg();
    $outputarr['response_data'][$i]['shared'] = $datalist[$i]->getShared();
    $outputarr['response_data'][$i]['start_date'] = $datalist[$i]->getStartDate();
    $outputarr['response_data'][$i]['end_date'] = $datalist[$i]->getEndDate();
    $outputarr['response_data'][$i]['status'] = $datalist[$i]->getStatus();
}
echo json_encode($outputarr);
