<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/21/15 AD
 * Time: 3:09 PM
 */

class PromotionController {

    static $promotionDaoImpl;

    static function loadClass()
    {
        self::$promotionDaoImpl = new PromotionDAOImpl();
    }

    static function addPromotion(Promotion $promotion){
        return self::$promotionDaoImpl->addNewPromotion($promotion);
    }

    static function deletePromotionByPromotionId($id){
        return self::$promotionDaoImpl->deletePromotionByPromotionId($id);
    }

    static function deletePromotionByShopId($shopId){
        return self::$promotionDaoImpl->deletePromotionByShopId($shopId);
    }

    static function editPromotion(Promotion $promotion){
        self::$promotionDaoImpl->editPromotion($promotion);
    }

    static function getPromotionById($id){
        return self::$promotionDaoImpl->getPromotionById($id);
    }

    static function getPromotionByName($name){
        return self::$promotionDaoImpl->getPromotionByName($name);
    }

    static function getPromotionByStatus($status){
        return self::$promotionDaoImpl->getPromotionByStatus($status);
    }

    static function getAllPromotion(){
        return self::$promotionDaoImpl->getAllPromotions();
    }

    static function getPromotionByShopId($id){
        return self::$promotionDaoImpl->getPromotionByShopId($id);
    }
} 