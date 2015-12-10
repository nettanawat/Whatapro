<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/21/15 AD
 * Time: 3:09 PM
 */

class RequestSignupController {

    static $requestSignupDaoImpl;

    static function loadClass(){
        self::$requestSignupDaoImpl = new RequestSignupInfoDAOImpl();
    }

    static function addRequest(RequestSignupInfo $requestSignupInfo){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $requestSignupInfo->setRequestDate($now->format('Y-m-d H:i:s'));
        $requestSignupInfo->setPassword(md5($requestSignupInfo->getAddress()));
        return self::$requestSignupDaoImpl->addNewRequest($requestSignupInfo);
    }

    static function getAllRequest(){
        return self::$requestSignupDaoImpl->getAllRequest();
    }

    static function getRequestById($id){
        return self::$requestSignupDaoImpl->getRequestSignupById($id);
    }

    static function rejectRequest($id, $accountId){
        return self::$requestSignupDaoImpl->updateRequestStatus($id,false, $accountId);
    }

    static function acceptRequest($id, $accountId){
        return self::$requestSignupDaoImpl->updateRequestStatus($id,true, $accountId);
    }
} 