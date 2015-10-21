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
        $this->promotion1 = new Promotion(1, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1);
        $this->promotion2 = new Promotion(2, 7, "Get a FREE order of Dog pretzel", "with the purchase of a Green mint mocha", 0, "2015-08-01 00:00:00", "2015-08-09 00:00:00", 1);
        $this->promotion3 = new Promotion(3, 8, "Show student card for a special 10% discount", "Not to be used in conjunction with other voucher", 0, "2015-08-18 00:00:00", "2015-09-09 00:00:00", 1);
        $this->promotion4 = new Promotion(4, 1002, "Free coffee or tea", "3pm – 6pm (Everyday)With any order on our menu + dessert menu", 0, "2015-07-28 00:00:00", "2015-09-28 00:00:00", 1);
        $this->promotion5 = new Promotion(5, 6, "Promotion 1", "This is description", 0, "2015-07-23 00:00:00", "2015-08-23 00:00:00", 1);
    }

    public function testAddPromotion(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $promotionDaoImpl->addNewPromotion($this->promotion1));
        $this->assertEquals(2, $promotionDaoImpl->addNewPromotion($this->promotion2));
        $this->assertEquals(3, $promotionDaoImpl->addNewPromotion($this->promotion3));
        Config::$connection->rollBack();
    }

    public function testGetPromotionByName(){
//        $promotionDaoImpl = new PromotionDAOImpl();
//        $this->assertEquals("", $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals("", $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals("", $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(31, $promotionDaoImpl->addNewPromotion($this->promotion1));
//        $this->assertEquals(32, $promotionDaoImpl->addNewPromotion($this->promotion1));
    }


    public function testGetPromotionByPromotionId(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion($this->promotion1);
        $promotionDaoImpl->addNewPromotion($this->promotion2);
        $this->assertEquals(new Promotion(1, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1) , $promotionDaoImpl->getPromotionById(1));
        $this->assertEquals(new Promotion(2, 7, "Get a FREE order of Dog pretzel", "with the purchase of a Green mint mocha", 0, "2015-08-01 00:00:00", "2015-08-09 00:00:00", 1), $promotionDaoImpl->getPromotionById(2));
        Config::$connection->rollBack();
    }

    public function testGetPromotionByShopId(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion(new Promotion(1, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1));
        $promotionDaoImpl->addNewPromotion(new Promotion(2, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1));
        $this->assertEquals(2, sizeof($promotionDaoImpl->getPromotionByShopId(6)));
        $this->assertEquals(0, sizeof($promotionDaoImpl->getPromotionByShopId(8)));
        $this->assertEquals(0, sizeof($promotionDaoImpl->getPromotionByShopId(253)));
        Config::$connection->rollBack();
    }

    public function testDeletePromotionByPromotionId(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion($this->promotion1);
        $promotionDaoImpl->addNewPromotion($this->promotion2);
        $this->assertEquals(1, $promotionDaoImpl->deletePromotionByPromotionId(1));
        $this->assertEquals(1, $promotionDaoImpl->deletePromotionByPromotionId(2));
        $this->assertEquals(0, $promotionDaoImpl->deletePromotionByPromotionId(33));
        Config::$connection->rollBack();
    }

    public function testDeletePromotionByShopId(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion(new Promotion(1, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1) , $promotionDaoImpl->getPromotionById(1));
        $promotionDaoImpl->addNewPromotion(new Promotion(2, 6, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1) , $promotionDaoImpl->getPromotionById(1));
        $promotionDaoImpl->addNewPromotion(new Promotion(3, 7, "Friday special !!", "Breakfast buffet 150.- for each", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1) , $promotionDaoImpl->getPromotionById(1));
        $this->assertEquals(2, $promotionDaoImpl->deletePromotionByShopId(6));
        $this->assertEquals(1, $promotionDaoImpl->deletePromotionByShopId(7));
        $this->assertEquals(0, $promotionDaoImpl->deletePromotionByShopId(1004));
        Config::$connection->rollBack();
    }

    public function testGetAllPromotion(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion($this->promotion1);
        $promotionDaoImpl->addNewPromotion($this->promotion2);
        $this->assertEquals(2, sizeof($promotionDaoImpl->getAllPromotions()));
        Config::$connection->rollBack();

    }

    public function testEditPromotion(){
        $promotionDaoImpl = new PromotionDAOImpl();
        Config::$connection->beginTransaction();
        $promotionDaoImpl->addNewPromotion($this->promotion1);
        $promotionDaoImpl->addNewPromotion($this->promotion2);
        $promotionDaoImpl->addNewPromotion($this->promotion4);
        $this->assertEquals(1, $promotionDaoImpl->editPromotion(new Promotion(1, 6, "Friday special !!", "Ok?", 0, "2015-07-23 00:00:00", "2015-07-31 00:00:00", 1)));
        $this->assertEquals(1, $promotionDaoImpl->editPromotion(new Promotion(2, 7, "WHAT??", "with the purchase of a Green mint mocha", 0, "2015-08-01 00:00:00", "2015-08-09 00:00:00", 1)));
        $this->assertEquals(0, $promotionDaoImpl->editPromotion(new Promotion(90, 100, "Free coffee or tea", "3pm – 6pm (Everyday)With any order on our menu + dessert menu", 0, "2015-07-28 00:00:00", "2015-09-28 00:00:00", 1)));
        Config::$connection->rollBack();
    }

    public function tearDown(){
        if(Config::$connection->inTransaction()){
            Config::$connection->rollBack();
        }
    }
}