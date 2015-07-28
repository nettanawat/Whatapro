<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcocuntController
 *
 * @author NetSmith
 */
class AccountController {

    static  $accountDaoImpl;

    static function loadClass(){
        self::$accountDaoImpl = new AccountDAOImpl();
    }

    static function doLogin($email, $password) {
        return self::$accountDaoImpl->doLogin($email,$password);
    }

    static function addNewAccount(AccountInfo $account) {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $account->setJoinDate($now->format('Y-m-d H:i:s'));
        $account->setPassword(md5($account->getPassword()));
        return self::$accountDaoImpl->addNewAccount($account);
    }

    static function getAllAccount(){
        return self::$accountDaoImpl->getAllAccounts();
    }

    static function getAccountById($id){
        return self::$accountDaoImpl->getAccountById($id);
    }

    static function getAccountByEmail($email){
        return self::$accountDaoImpl->getAccountByEmail($email);
    }

    static function editAccount(AccountInfo $accountInfo){
        return self::$accountDaoImpl->editAccount($accountInfo);
    }

    static function changePassword($id, $password){
        return self::$accountDaoImpl->changePassword($id, $password);
    }

    static function deleteAccount($id){
        return self::$accountDaoImpl->deleteAccount($id);
    }

    static function getLastFiveAccount(){
        return self::$accountDaoImpl->getLastFiveAccount();
    }

    static function searchIdOrEmailOrName($keyword){
        return self::$accountDaoImpl->getAccountByIdOrEmailOrShopName($keyword);
    }
}
