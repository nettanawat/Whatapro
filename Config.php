<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 3/27/15 AD
 * Time: 3:55 PM
 */

class Config {

    const DATABASE_TYPE = 'mysql';
    const DATABASE_NAME = 'WAP';
    const DATABASE_DNS = 'mysql:host=127.0.0.1;dbname=WAP';
    const SERVER = '127.0.0.1';
    const DATABASE_USERNAME = 'root';
    const DATABASE_PASSWORD = '';
    const USERNAME = 'root';
    const PASSWORD = '';
    const CHARSET = 'utf8';
    const PATH = '/whatapro';
    const ADMIN_USERNAME ='nettanawat@gmail.com';
    const ADMIN_PASSWORD ='c09e487ab20c68cdc5c21dce226b0426';
    static $connection = '';

    static $className =  array(
        'AccountController' => 'src/controller/AccountController',
        'PromotionController' => 'src/controller/PromotionController',
        'ShopInformationController' => 'src/controller/ShopInformationController',
        'RequestSignupController' => 'src/controller/RequestSignupController',
        'ShopImageController' => 'src/controller/ShopImageController',
        'PromotionImageController' => 'src/controller/PromotionImageController',
        'RedeemCodeController' => 'src/controller/RedeemCodeController',
        'PointController' => 'src/controller/PointController',
        'MobileUserController' => 'src/controller/MobileUserController',
        'Adaptor' => 'library/Adaptor',
        'AccountDAO' => 'src/dao/AccountDAO',
        'AccountDAOImpl' => 'src/dao/AccountDAOImpl',
        'CheckInCodeDAO' => 'src/dao/CheckInCodeDAO',
        'CheckInCodeDAOImpl' => 'src/dao/CheckInCodeDAOImpl',
        'ShopImageDAO' => 'src/dao/ShopImageDAO',
        'ShopImageDAOImpl' => 'src/dao/ShopImageDAOImpl',
        'PromotionDAO' => 'src/dao/PromotionDAO',
        'PromotionDAOImpl' => 'src/dao/PromotionDAOImpl',
        'RequestSignupInfoDAO' => 'src/dao/RequestSignupInfoDAO',
        'RequestSignupInfoDAOImpl' => 'src/dao/RequestSignupInfoDAOImpl',
        'ShopInformationDAO' => 'src/dao/ShopInformationDAO',
        'ShopInformationDAOImpl' => 'src/dao/ShopInformationDAOImpl',
        'PromotionImageDAO' => 'src/dao/PromotionImageDAO',
        'PromotionImageDAOImpl' => 'src/dao/PromotionImageDAOImpl',
        'RedeemCodeDAO' => 'src/dao/RedeemCodeDAO',
        'RedeemCodeDAOImpl' => 'src/dao/RedeemCodeDAOImpl',
        'PointDAO' => 'src/dao/PointDAO',
        'PointDAOImpl' => 'src/dao/PointDAOImpl',
        'MobileUserDAO' => 'src/dao/MobileUserDAO',
        'MobileUserDAOImpl' => 'src/dao/MobileUserDAOImpl',
        'AccountInfo' => 'src/entity/AccountInfo',
        'CheckInCode' => 'src/entity/CheckInCode',
        'Promotion' => 'src/entity/Promotion',
        'RequestSignupInfo' => 'src/entity/RequestSignupInfo',
        'ShopInformation' => 'src/entity/ShopInformation',
        'ShopImage' => 'src/entity/ShopImage',
        'PromotionImage' => 'src/entity/PromotionImage',
        'RedeemCode' => 'src/entity/RedeemCode',
        'PointInfo' => 'src/entity/PointInfo',
        'MobileUser' => 'src/entity/MobileUser',
        'SQLConnector' => 'Library/SQLConnector',
    );
}

include 'Library/medoo.php';
include 'GenerateData.php';

function __autoload($class_name) {
    if(Config::$className[$class_name]!=null || Config::$className[$class_name]!="")
        include dirname(__FILE__).'/'.Config::$className[$class_name].'.php';
    GenerateData::createAdmin();
    Config::$connection = new PDO(Config::DATABASE_DNS, Config::DATABASE_USERNAME, Config::DATABASE_PASSWORD);
}

function clearConnection(){
    Config::$connection = null;
}

AccountController::loadClass();
PromotionController::loadClass();
RequestSignupController::loadClass();
ShopInformationController::loadClass();
RedeemCodeController::loadClass();
PointController::loadClass();
MobileUserController::loadClass();