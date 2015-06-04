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
    public function addNewAccount(AccountInfo $account);
    public function editAccount(AccountInfo $account);
    public function changePassword(AccountInfo $account);
    public function disableAccount($id);
    public function enableAccount($id);
//    public function getAccountByStatus($status);
}
