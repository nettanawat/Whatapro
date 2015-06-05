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
        return self::$requestSignupDaoImpl->addNewRequest($requestSignupInfo);
    }

    static function getAllRequest(){
        return self::$requestSignupDaoImpl->getAllRequest();
    }
} 