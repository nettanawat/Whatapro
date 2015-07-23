<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/3/15 AD
 * Time: 3:11 PM
 */

include dirname(__FILE__) . '/../Config.php';
if(isset($_GET['promotionImageId'])){
    $imageId = $_GET['promotionImageId'];
    $promotionImageController = new PromotionImageController();
    unlink("../".$promotionImageController->getImageById($imageId)->getImagePath());
    $promotionImageController->deleteImageById($imageId);
    echo $imageId;
}

