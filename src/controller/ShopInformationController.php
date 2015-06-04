<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/24/15 AD
 * Time: 12:35 AM
 */

class ShopInformationController {
    static $shopInformationDaoImpl;

    static function loadClass(){
        self::$shopInformationDaoImpl = new ShopInformationDAOImpl();
    }

    static function addShopInformation(ShopInformation $shopInfo){
        return self::$shopInformationDaoImpl->addNewShopInformation($shopInfo);
    }

    static function deleteShopInformation($id){
        return self::$shopInformationDaoImpl->deleteShopInformation($id);
    }

    static function editShopInformation(ShopInformation $shopInfo){
        self::$shopInformationDaoImpl->editShopInformation($shopInfo);
    }

    static function getAllShopInformation(){
        return self::$shopInformationDaoImpl->getAllShopInformation();
    }

    static function getShopInformationById($id){
        return self::$shopInformationDaoImpl->getShopInformationById($id);
    }
}