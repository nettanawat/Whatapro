<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:26 PM
 */
include dirname(__FILE__) . '/../Config.php';

class PromotionDAOImplTest extends PHPUnit_Framework_TestCase {

    private $promotion1 = '';
    private $promotion2 = '';
    private $promotion3 = '';
    private $promotion4 = '';
    private $promotion5 = '';

    public function setUp(){
        $this->promotion1 = new Promotion(28, 65, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
        $this->promotion2 = new Promotion(29, 66, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
        $this->promotion3 = new Promotion(30, 67, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
        $this->promotion4 = new Promotion(31, 68, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
        $this->promotion5 = new Promotion(32, 69, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
    }

//    public function testGetPromotionByName(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $this->assertEquals(28, $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(29, $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(30, $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(31, $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(32, $promotionDaoImpl->addNewPromotion($this->promotion1));
//    }


//    public function testGetPromotionByPromotionId(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $promotion = $promotionDaoImpl->getPromotionById(28);
//        $this->assertEquals(28, $promotion->getPromotionId());
//        $this->assertEquals(65, $promotion->getAccountId());
//        $this->assertEquals("Promotion 1", $promotion->getName());
//        $this->assertEquals( new Promotion(29, 65, 'Promotion 1', 'This is description', 0, '2015-07-23 00:00:00', '2015-08-23 00:00:00', 1), $promotionDaoImpl->getPromotionById(29));
//    }

//    public function testGetPromotionByShopId(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $this->assertEquals(10, sizeof($promotionDaoImpl->getPromotionByShopId(65)));
//    }

//    public function testDeletePromotionByPromotionId(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $this->assertEquals(1, $promotionDaoImpl->deletePromotionByPromotionId(24));
//        $this->assertEquals(1, $promotionDaoImpl->deletePromotionByPromotionId(23));
//    }

//    public function testDeletePromotionByShopId(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $this->assertEquals(8, sizeof($promotionDaoImpl->deletePromotionByShopId(65)));
//    }

    public function testGetAllPromotion(){
        $promotionDaoImpl = new PromotionDAOImpl();
        $this->assertEquals(1, sizeof($promotionDaoImpl->getAllPromotions()));
    }

    public function testEditPromotion(){
        $promotionDaoImpl = new PromotionDAOImpl();
        $this->assertEquals(1, $promotionDaoImpl->editPromotion(new Promotion(21, 69, 'Test edit unit test t', 'adadsaasdadadadadasdad', 0, '2015-07-01 00:00:00', '2015-07-16 00:00:00', 1)));
        $this->assertEquals(null, $promotionDaoImpl->editPromotion(new Promotion(22, 69, 'Test edit unit test', 'adadsaasdadadadadasdad', 0, '2015-07-01 00:00:00', '2015-07-16 00:00:00', 1)));
    }


}

 