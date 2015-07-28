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
    const DATABASE_DNS = 'mysql:host=localhost;dbname=WAP';
    const SERVER = '127.0.0.1';
    const USERNAME = 'root';
    const PASSWORD = '';
    const CHARSET = 'utf8';
    const PATH = '/whatapro';
    const ADMIN_USERNAME ='nettanawat@gmail.com';
    const ADMIN_PASSWORD ='c09e487ab20c68cdc5c21dce226b0426';

    static $className =  array(
        'AccountController' => 'src/controller/AccountController',
        'ActivitiesLogController' => 'src/controller/ActivitiesLogController',
        'PromotionController' => 'src/controller/PromotionController',
        'ShopInformationController' => 'src/controller/ShopInformationController',
        'RequestSignupController' => 'src/controller/RequestSignupController',
        'ShopImageController' => 'src/controller/ShopImageController',
        'PromotionImageController' => 'src/controller/PromotionImageController',
        'RedeemCodeController' => 'src/controller/RedeemCodeController',
        'Adaptor' => 'library/Adaptor',
        'AccountDAO' => 'src/dao/AccountDAO',
        'AccountDAOImpl' => 'src/dao/AccountDAOImpl',
        'ActivitiesLogDAO' => 'src/dao/ActivitiesLogDAO',
        'ActivitiesLogDAOImpl' => 'src/dao/ActivitiesLogDAOImpl',
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
        'AccountInfo' => 'src/entity/AccountInfo',
        'ActivitiesLog' => 'src/entity/ActivitiesLog',
        'CheckInCode' => 'src/entity/CheckInCode',
        'Promotion' => 'src/entity/Promotion',
        'RequestSignupInfo' => 'src/entity/RequestSignupInfo',
        'ShopInformation' => 'src/entity/ShopInformation',
        'ShopImage' => 'src/entity/ShopImage',
        'PromotionImage' => 'src/entity/PromotionImage',
        'RedeemCode' => 'src/entity/RedeemCode',
        'SQLConnector' => 'Library/SQLConnector',
    );
}

include 'Library/medoo.php';
include 'GenerateData.php';

function __autoload($class_name) {
    if(Config::$className[$class_name]!=null || Config::$className[$class_name]!="")
        include dirname(__FILE__).'/'.Config::$className[$class_name].'.php';
//    GenerateData::createAdmin();
//    GenerateData::generateAccount(10);
}

AccountController::loadClass();
ActivitiesLogController::loadClass();
PromotionController::loadClass();
RequestSignupController::loadClass();
ShopInformationController::loadClass();
RedeemCodeController::loadClass();