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
        self::$accountDaoImpl->editAccount($accountInfo);
    }

    static function changePassword(AccountInfo $accountInfo){
        self::$accountDaoImpl->changePassword($accountInfo);
    }

    static function deleteAccount($id){
        return self::$accountDaoImpl->deleteAccount($id);
    }

    static function getLastFiveAccount(){
        return self::$accountDaoImpl->getLastFiveAccount();
    }

}
