<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/27/15 AD
 * Time: 2:10 PM
 */

include dirname(__FILE__) . '/../Config.php';

class ShopImageDAOImplTest extends PHPUnit_Framework_TestCase {

    private $shop1 = '';
    private $shop2 = '';
    private $shop3 = '';
    private $shop4 = '';

    public function setUp(){
        $this->shop1 = new ShopImage(null, 6, "user_upload/6/shop_images/cookies.png", "2015-07-03 00:00:00");
        $this->shop2 = new ShopImage(null, 7, "Xxxasdad34234", "2015-07-03 00:00:00");
        $this->shop3 = new ShopImage(null, 78, "user_upload/6/shop_images/cookies.png", "2015-07-03 00:00:00");
        $this->shop4 = new ShopImage(null, 100, "user_upload/6/shop_images/cookies.png", "2015-07-03 00:00:00");
    }

    public function testAddImage(){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $shopImageDaoImpl->addImage($this->shop1));
        $this->assertEquals(2, $shopImageDaoImpl->addImage($this->shop2));
        $this->assertEquals(0, $shopImageDaoImpl->addImage($this->shop3));
        $this->assertEquals(0, $shopImageDaoImpl->addImage($this->shop4));
        Config::$connection->rollBack();
    }

    public function testDeleteImageByShopId(){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        Config::$connection->beginTransaction();
        $shopImageDaoImpl->addImage($this->shop1);
        $shopImageDaoImpl->addImage($this->shop2);
        $this->assertEquals(1, $shopImageDaoImpl->deleteImageByShopId(6));
        $this->assertEquals(1, $shopImageDaoImpl->deleteImageByShopId(7));
        $this->assertEquals(0, $shopImageDaoImpl->deleteImageByShopId(100));
        $this->assertEquals(0, $shopImageDaoImpl->deleteImageByShopId(2885));
        Config::$connection->rollBack();
    }

    public function testGetImageByAccountId(){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        Config::$connection->beginTransaction();
        $shopImageDaoImpl->addImage($this->shop1);
        $shopImageDaoImpl->addImage($this->shop2);
        $this->assertEquals(1, sizeof($shopImageDaoImpl->getImageByAccountId(6)));
        $this->assertEquals(1, sizeof($shopImageDaoImpl->getImageByAccountId(7)));
        $this->assertEquals(0, sizeof($shopImageDaoImpl->getImageByAccountId(99)));
        $this->assertEquals(0, sizeof($shopImageDaoImpl->getImageByAccountId(250)));
        Config::$connection->rollBack();
    }


    public function testDeleteImageById(){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        Config::$connection->beginTransaction();
        $shopImageDaoImpl->addImage($this->shop1);
        $shopImageDaoImpl->addImage($this->shop2);
        $this->assertEquals(1, $shopImageDaoImpl->deleteImageById(1));
        $this->assertEquals(1, $shopImageDaoImpl->deleteImageById(2));
        $this->assertEquals(0, $shopImageDaoImpl->deleteImageById(100));
        $this->assertEquals(0, $shopImageDaoImpl->deleteImageById(250));
        Config::$connection->rollBack();
    }

    public function testGetImageById(){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        Config::$connection->beginTransaction();
        $shopImageDaoImpl->addImage($this->shop1);
        $shopImageDaoImpl->addImage($this->shop2);
        $this->assertEquals(new ShopImage(1, 6, "user_upload/6/shop_images/cookies.png", "2015-07-03 00:00:00"), $shopImageDaoImpl->getImageById(1));
        $this->assertEquals(new ShopImage(2, 7, "Xxxasdad34234", "2015-07-03 00:00:00"), $shopImageDaoImpl->getImageById(2));
        $this->assertEquals(null, $shopImageDaoImpl->getImageById(85));
        $this->assertEquals(null, $shopImageDaoImpl->getImageById(100));
        Config::$connection->rollBack();
    }
}