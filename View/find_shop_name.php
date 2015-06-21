<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/9/15 AD
 * Time: 12:48 AM
 */
include dirname(__FILE__) . '/../Config.php';

$shopInfo = ShopInformationController::getShopInformationById($_GET['shopId']);
echo $shopInfo->getName();
