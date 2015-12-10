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


    public function setUp(){
        $this->shopInformation1 = new ShopInformation(10, "Oh yeah", "41 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053 400 888", 1, 18.7951095, 98.9650533, "Every day", "This is description", null);
        $this->shopInformation2 = new ShopInformation(11, "Hello", "41 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053 400 888", 2, 18.7951095, 98.9650533, "Everyday", "This is description", null);
        $this->shopInformation3 = new ShopInformation(12, "Coffee smith", "41 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053 400 888", 3, 18.7951095, 98.9650533, "6.00 - 12.00", "This is description", null);
        $this->shopInformation4 = new ShopInformation(100, "Test add", "41 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053 400 888", 4, 18.7951095, 98.9650533, "All time no close", "This is description", null);
    }

    public function testGetShopInformationById(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        Config::$connection->beginTransaction();
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation1);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation2);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation3);
        $this->assertEquals($this->shopInformation1, $shopInformationDaoImpl->getShopInformationById(10));
        $this->assertEquals($this->shopInformation2, $shopInformationDaoImpl->getShopInformationById(11));
        $this->assertEquals($this->shopInformation3, $shopInformationDaoImpl->getShopInformationById(12));
        $this->assertEquals(null, $shopInformationDaoImpl->getShopInformationById(100));
        Config::$connection->rollBack();
    }

    public function testAddNewShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(10, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation1));
        $this->assertEquals(11, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation2));
        $this->assertEquals(12, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation3));
        $this->assertEquals(12, $shopInformationDaoImpl->addNewShopInformation($this->shopInformation4));
        Config::$connection->rollBack();
    }

    public function testDeleteShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        Config::$connection->beginTransaction();
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation1);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation2);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation3);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation4);
        $this->assertEquals(1, $shopInformationDaoImpl->deleteShopInformation(10));
        $this->assertEquals(1, $shopInformationDaoImpl->deleteShopInformation(11));
        $this->assertEquals(1, $shopInformationDaoImpl->deleteShopInformation(12));
        $this->assertEquals(0, $shopInformationDaoImpl->deleteShopInformation(100));
        Config::$connection->rollBack();
    }

    public function testGetAllShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        $this->assertEquals(4, sizeof($shopInformationDaoImpl->getAllShopInformation()));

    }

    public function testEditShopInformation(){
        $shopInformationDaoImpl = new ShopInformationDAOImpl();
        Config::$connection->beginTransaction();
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation1);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation2);
        $shopInformationDaoImpl->addNewShopInformation($this->shopInformation3);
        $this->shopInformation1->setName("Hiii");
        $this->shopInformation2->setName("Hey yo");
        $this->shopInformation3->setName("setName");
        $this->shopInformation4->setAccountId(100);
        $this->assertEquals(1, $shopInformationDaoImpl->editShopInformation($this->shopInformation1));
        $this->assertEquals(1, $shopInformationDaoImpl->editShopInformation($this->shopInformation2));
        $this->assertEquals(1, $shopInformationDaoImpl->editShopInformation($this->shopInformation3));
        $this->assertEquals(0, $shopInformationDaoImpl->editShopInformation($this->shopInformation4));
        Config::$connection->rollBack();

    }

    public function tearDown(){
        if(Config::$connection->inTransaction()){
            Config::$connection->rollBack();
        }
    }

}
 