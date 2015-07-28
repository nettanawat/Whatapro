<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/25/15 AD
 * Time: 12:34 PM
 */

include_once '../Config.php';
$shopImageController = new ShopImageController();
var_dump($shopImageController->addImage(new ShopImage("", 68,"asad", null)));