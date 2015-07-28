<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 8:09 PM
 */

class ShopImageController {

    function addImage(ShopImage $shopImage){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $shopImage->setAddDate($now->format('Y-m-d H:i:s'));
        $shopImageDaoImpl = new ShopImageDAOImpl();
        return $shopImageDaoImpl->addImage($shopImage);
    }

    function getImageByAccountId($accountId){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        return $shopImageDaoImpl->getImageByAccountId($accountId);
    }

    function deleteShopImageByShopId($shopId){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        return $shopImageDaoImpl->deleteImageByShopId($shopId);
    }

    function deleteShopImageById($id){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        return $shopImageDaoImpl->deleteImageById($id);
    }

    function getShopImageById($id){
        $shopImageDaoImpl = new ShopImageDAOImpl();
        return $shopImageDaoImpl->getImageById($id);
    }
}