<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountDAOImpl
 *
 * @author NetSmith
 */
class AccountDAOImpl implements AccountDAO {
    private $database = '';
    private $table = 'Accounts';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function doLogin($email, $password){
        $row = $this->database->get($this->table,'*',['AND'=>['email'=>$email, 'password'=>md5($password), 'status' => 1]]);
        if(false == $row) {
            return null;
        }else{
            return new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
        }
    }

    public function addNewAccount(AccountInfo $account) {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $account->setJoinDate($now->format('Y-m-d H:i:s'));

            $data = [
                'id' => $account->getAccountId(),
                'email' => $account->getEmail(),
                'password' => md5($account->getPassword()),
                'role' => $account->getRole(),
                'join_date' => $account->getJoinDate(),
                'status' => $account->getStatus()
                ];
        return $this->database->insert($this->table, $data);
    }

    public function editAccount(AccountInfo $account) {
        $query = "UPDATE Accounts SET email = '".$account->getEmail()."' WHERE id = '".$account->getAccountId()."'";
        $this->database->exec($query);
    }

    public function getAccountById($id) {
        $row = $this->database->get($this->table,'*',['AND'=>['id'=>$id]]);
        if($row) {
            return new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
        } else {
            return null;
        }
    }

    public function getAccountByEmail($email) {
        $accountList = array();
        foreach ($this->database->select($this->table,'*',['AND'=>['email'=>$email]]) as $row) {
            $accountList[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
        }
        return $accountList;
    }

    public function getAllAccounts() {
        $accountList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $accountList[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
        }
        return $accountList;
    }

    public function changePassword(AccountInfo $accountInfo){
        $query = "UPDATE Accounts SET password = '".md5($accountInfo->getPassword())."' WHERE id = '".$accountInfo->getAccountId()."'";
        $this->database->exec($query);
    }

    public function deleteAccount($id){
        return $this->database->delete($this->table, ["AND" => ["id" => $id]]);
    }

    public function getLastFiveAccount() {
        $accountList = array();
        foreach ($this->database->select($this->table,'*',['LIMIT' => 5, 'ORDER' => 'join_date DESC']) as $row) {
            $accountList[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
        }
        return $accountList;
    }
}

