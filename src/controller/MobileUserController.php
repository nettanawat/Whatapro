<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/15/15 AD
 * Time: 12:17 PM
 */

class MobileUserController {

    static  $mobileUserDaoImpl;

    static function loadClass(){
        self::$mobileUserDaoImpl = new MobileUserDAOImpl();
    }

    static function addMobileUser(MobileUser $mobileUser){
        return self::$mobileUserDaoImpl->addMobileUser($mobileUser);
    }

    static function getAllMobileUser(){
        return self::$mobileUserDaoImpl->getAll();
    }

    static function getByFBId($id){
        return self::$mobileUserDaoImpl->getMobileUserByFbId($id);
    }

    static function addPoint($FBid, $point){
        return self::$mobileUserDaoImpl->addPoint($FBid, $point);
    }

    static function deductPoint($FBid, $point){
        $code = RedeemCodeController::generateRedeemCode($FBid, $point);
        self::$mobileUserDaoImpl->deductPoint($FBid, $point);
        return $code;
    }


} 