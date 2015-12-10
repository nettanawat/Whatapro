<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/12/15 AD
 * Time: 3:21 PM
 */

class PointController {
    static  $pointDaoImpl;

    static function loadClass(){
        self::$pointDaoImpl = new PointDAOImpl();
    }

    static function receivePoint(PointInfo $pointInfo){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $pointInfo->setDate($now->format('Y-m-d H:i:s'));
        $pointInfo->setSpendPoint(null);
        $pointInfo->setMobileUserId(null);
        return self::$pointDaoImpl->addReceivePoint($pointInfo);
    }

    static function spendPoint(PointInfo $pointInfo){
        $pointInfo->setDate(null);
        $pointInfo->setReceivePoint(null);
        $pointInfo->setMobileUserId(null);
        return self::$pointDaoImpl->addSpendPoint($pointInfo);
    }
} 