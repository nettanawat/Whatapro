<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:26 PM
 */
include_once '../entity/PromotionDAOImpl.php';
include_once '../Library/SQLConnector.php';
class PromotionDAOImplTest extends PHPUnit_Framework_TestCase {
    public function testGetPromotionByName(){
        SQLConnector::startConnection();
        $promotionDAOImpl = new PromotionDAOImpl();
        // test with email = admin1@wap.com
        $query = "SELECT * from Promotions WHERE name='Free bar'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $promotion = new Promotion($row['id'], $row['accounts_id'], $row['name'], $row['description'], $row['img'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        $this->assertEquals($promotion, $promotionDAOImpl->getPromotionByName("Free bar"));
    }


    public function testGetPromotionById(){
        $promotionDAOImpl = new PromotionDAOImpl();
        // test with id = 1
        $query = "SELECT * from Promotions WHERE id=1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $promotion = new Promotion($row['id'], $row['accounts_id'], $row['name'], $row['description'], $row['img'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        $this->assertEquals($promotion, $promotionDAOImpl->getPromotionById(1));

        $query = "SELECT * from Promotions WHERE id=2";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $promotion = new Promotion($row['id'], $row['accounts_id'], $row['name'], $row['description'], $row['img'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        $this->assertEquals($promotion, $promotionDAOImpl->getPromotionById(2));
    }
}
 