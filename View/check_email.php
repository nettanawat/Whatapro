<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/21/15 AD
 * Time: 12:45 AM
 */
include dirname(__FILE__) . '/../Config.php';

if(AccountController::getAccountByEmail($_GET['key']) == null) {
    echo true;
} else {
    echo false;
}