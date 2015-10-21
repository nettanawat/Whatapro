<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/15/15 AD
 * Time: 4:36 PM
 */

include dirname(__FILE__) . '/../Config.php';

class PromotionImageDaoImplTest extends PHPUnit_Framework_TestCase {

    private $promotion1 ='';
    private $promotion2 ='';
    private $promotion3 ='';
    private $promotion4 ='';

    public function setUp(){
        $this->promotion1 = new PromotionImage(1, 200, "user_upload/16/shop_images/amazon.jpg", "2015-07-23 15:11:24");
        $this->promotion2 = new PromotionImage(2, 200, "user_upload/16/shop_images/sale.jpg", "2015-07-23 15:11:24");
        $this->promotion3 = new PromotionImage(3, 201, "user_upload/21/shop_images/wanilla.jpg", "2015-07-23 15:11:24");
        $this->promotion4 = new PromotionImage(4, 100, "user_upload/100/shop_images/latte.jpg", "2015-07-23 15:11:24");
    }

    public function testAddImage() {
        $promotionImageDaoImpl = new PromotionImageDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $promotionImageDaoImpl->addImage($this->promotion1));
        $this->assertEquals(2, $promotionImageDaoImpl->addImage($this->promotion2));
        $this->assertEquals(3, $promotionImageDaoImpl->addImage($this->promotion3));
        $this->assertEquals(0, $promotionImageDaoImpl->addImage($this->promotion4));
        Config::$connection->rollBack();
    }

    public function testGetImageByPromotionId() {
        $promotionImageDaoImpl = new PromotionImageDAOImpl();
        Config::$connection->beginTransaction();
        $promotionImageDaoImpl->addImage($this->promotion1);
        $promotionImageDaoImpl->addImage($this->promotion2);
        $promotionImageDaoImpl->addImage($this->promotion3);
        $this->assertEquals(2, sizeof($promotionImageDaoImpl->getImageByPromotionId(200)));
        $this->assertEquals(1, sizeof($promotionImageDaoImpl->getImageByPromotionId(201)));
        $this->assertEquals(0, sizeof($promotionImageDaoImpl->getImageByPromotionId(203)));
        Config::$connection->rollBack();
    }

    public function testGetImageById() {
        $promotionImageDaoImpl = new PromotionImageDAOImpl();
        Config::$connection->beginTransaction();
        $promotionImageDaoImpl->addImage($this->promotion1);
        $promotionImageDaoImpl->addImage($this->promotion2);
        $this->assertEquals($this->promotion1, $promotionImageDaoImpl->getImageById(1));
        $this->assertEquals($this->promotion2, $promotionImageDaoImpl->getImageById(2));
        $this->assertEquals(null, $promotionImageDaoImpl->getImageById(100));
        $this->assertEquals(null, $promotionImageDaoImpl->getImageById(1009));
        Config::$connection->rollBack();
    }

    public function testDeleteImageByPromotionId() {
        $promotionImageDaoImpl = new PromotionImageDAOImpl();
        Config::$connection->beginTransaction();
        $promotionImageDaoImpl->addImage($this->promotion1);
        $promotionImageDaoImpl->addImage($this->promotion2);
        $promotionImageDaoImpl->addImage($this->promotion3);
        $this->assertEquals(2, $promotionImageDaoImpl->deleteImageByPromotionId(200));
        $this->assertEquals(1, $promotionImageDaoImpl->deleteImageByPromotionId(201));
        $this->assertEquals(0, $promotionImageDaoImpl->deleteImageByPromotionId(19));
        $this->assertEquals(0, $promotionImageDaoImpl->deleteImageByPromotionId(23));
        Config::$connection->rollBack();
    }

    public function testDeleteImageById() {
        $promotionImageDaoImpl = new PromotionImageDAOImpl();
        Config::$connection->beginTransaction();
        $promotionImageDaoImpl->addImage($this->promotion1);
        $promotionImageDaoImpl->addImage($this->promotion2);
        $this->assertEquals(1, $promotionImageDaoImpl->deleteImageById(1));
        $this->assertEquals(1, $promotionImageDaoImpl->deleteImageById(2));
        $this->assertEquals(0, $promotionImageDaoImpl->deleteImageById(100));
        $this->assertEquals(0, $promotionImageDaoImpl->deleteImageById(80));
        Config::$connection->rollBack();
    }

} 