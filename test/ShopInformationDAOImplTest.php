<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/13/14 AD
 * Time: 9:47 AM
 */
include dirname(__FILE__) . '/../Config.php';
class ShopInformationDAOImplTest extends PHPUnit_Framework_TestCase {

    private $shopInformation1 = '';
    private $shopInformation2 = '';
    private $shopInformation3 = '';
    private $shopInformation4 = '';
    private $shopInformation5 = '';

    public function setUp(){
        $this->shopInformation1 = new ShopInformation(73, "Coffee smith", "696 Moo 15, Tumbol Booheaw", "0533333333", null, 18.7906989079, 98.9626121521, "Everyday from 6.00AM - 10.00PM", "This is description", null);
        $this->shopInformation2 = new ShopInformation(73, "Coffee smith nimman", "696 Moo 15, Tumbol Booheaw", "0533333333", null, 18.7906989079, 98.9626121521, "Everyday from 6.00AM - 10.00PM", "This is description", null);

        $this->shopInformation3 = new ShopInformation(69, "Coffee smith", "696 Moo 15, Tumbol Booheaw", "0533333333", null, 18.7906989079, 98.9626121521, "Everyday from 6.00AM - 10.00PM", "This is description", null);
        $this->shopInformation4 = new ShopInformation(72, "Coffee smith", "696 Moo 15, Tumbol Booheaw", "0533333333", null, 18.7906989079, 98.9626121521, "Everyday from 6.00AM - 10.00PM", "This is description", null);
//        $this->shopInformation5 = new ShopInformation(null, "Coffee smith", "696 Moo 15, Tumbol Booheaw", "0533333333", null, 18.7906989079, 98.9626121521, "Everyday from 6.00AM - 10.00PM", "This is description", null);
    }

    public function testGetShopInformationById(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        $this->assertEquals($this->shopInformation1, $shopInformationDaoImpl->getShopInformationById(73));
        $this->assertEquals(null, $shopInformationDaoImpl->getShopInformationById(75));
    }

//    public function testAddNewShopInformation(){
//        $shopInformationDaoImpl = new ShopInformationDAOImpl();
//        $this->assertEquals(69, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation3));
//        $this->assertEquals(72, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation4));
//    }

//    public function testDeleteShopInformation(){
//        $shopInformationDaoImpl = new ShopInformationDAOImpl();
//        $this->assertEquals(1, $shopInformationDaoImpl->deleteShopInformation(72));
//        $this->assertEquals(1, $shopInformationDaoImpl->deleteShopInformation(71));
//    }

    public function testGetAllShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        $this->assertEquals(17, sizeof($shopInformationDaoImpl->getAllShopInformation()));

    }

    public function testEditShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();

        $this->assertEquals(1, sizeof($shopInformationDaoImpl->editShopInformation(new ShopInformation(68, "Test eddit", null, null, null, null, null, null, null, null))));
    }
}
 