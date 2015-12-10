<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/7/15 AD
 * Time: 6:48 PM
 */
include_once '../Config.php';
if(isset($_GET['login'])) {
    $outputarr['response_data']['login'] = "Yeah";
    echo json_encode($outputarr);
}

if(isset($_POST['fbId']) && isset($_POST['fbUsername'])){
    $id = MobileUserController::addMobileUser(new MobileUser($_POST['fbId'], $_POST['fbUsername'], $id));
    $outputarr['response_data']['login'] = $id;
    echo json_encode($outputarr);
}
