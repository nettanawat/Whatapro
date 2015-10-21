<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/25/15 AD
 * Time: 12:34 PM
 */

include_once '../Config.php';

$promotionDaoImpl = new PromotionDAOImpl();
$shop = new ShopInformationDAOImpl();
var_dump($shop->addNewShopInformation(new ShopInformation(100, "Test add", "41 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053 400 888", 4, 18.7951095, 98.9650533, "All time no close", "This is description", null)));
echo '<pre>';
//var_dump();
echo '<pre>';