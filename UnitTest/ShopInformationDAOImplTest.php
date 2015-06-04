<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/13/14 AD
 * Time: 9:47 AM
 */
include_once '../entity/ShopInformationDAOImpl.php';
include_once '../Library/SQLConnector.php';
class ShopInformationDAOImplTest extends PHPUnit_Framework_TestCase {
    public function testGetShopInformationById(){
        $shopInformationDAOImpl = new ShopInformationDAOImpl();
        // test with id = 1
        SQLConnector::startConnection();
        $query = "SELECT * from ShopInformations WHERE accounts_id=100";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $shopInformation = new ShopInformation($row['id'], $row['accounts_id'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['image']);
        $this->assertEquals($shopInformation, $shopInformationDAOImpl->getShopInformationById(100));

        $query = "SELECT * from ShopInformations WHERE accounts_id=101";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $shopInformation = new ShopInformation($row['id'], $row['accounts_id'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['image']);
        $this->assertEquals($shopInformation, $shopInformationDAOImpl->getShopInformationById(101));

        $query = "SELECT * from ShopInformations WHERE accounts_id=102";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $shopInformation = new ShopInformation($row['id'], $row['accounts_id'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['image']);
        $this->assertEquals($shopInformation, $shopInformationDAOImpl->getShopInformationById(102));
    }
}
 