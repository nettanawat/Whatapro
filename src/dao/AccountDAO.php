<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountDAO
 *
 * @author NetSmith
 */
interface AccountDAO {
    public function getAllAccounts();
    public function getAccountByEmail($email);
    public function getAccountById($id);
    public function addNewAccount(AccountInfo $account);
    public function changePassword($id, $password);
    public function getLastFiveAccount();
    public function deleteAccount($id);
    public function doLogin($email, $password);
}
