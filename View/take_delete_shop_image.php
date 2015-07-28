<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/2/15 AD
 * Time: 9:50 PM
 */
include dirname(__FILE__) . '/../Config.php';
if(isset($_GET['shopImageId'])){
    $imageId = $_GET['shopImageId'];
    $shopImageController = new ShopImageController();
    try{
        unlink("../".$shopImageController->getShopImageById($imageId)->getImagePath());
        $shopImageController->deleteShopImageById($imageId);
        echo $imageId;
    } catch (Exception $ex) {
        echo ($ex);
    }
}
