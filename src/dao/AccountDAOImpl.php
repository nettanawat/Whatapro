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

    public function doLogin($email, $password){

        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM Accounts WHERE email = '".$email."' AND password ='".md5($password)."'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false){
                $result =  null;
            } else {
                $result =  new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }

        return $result;
    }

    public function addNewAccount(AccountInfo $account) {
        $account->setJoinDate(null);
        $account->setStatus(null);
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id FROM Accounts ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id='';
            if($account->getAccountId() != null){
                $id = $account->getAccountId();
            } else{
                $id = $lastId['id']+1;
            }
            $query ="INSERT INTO Accounts (id, email, password, role, join_date, status) VALUES (".$id.", '".$account->getEmail()."', '".$account->getPassword()."', '".$account->getRole()."', '".$account->getJoinDate()."', 1)";
            $row = Config::$connection->query($query);
            $result = Config::$connection->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function getAccountById($id) {
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM Accounts WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getAccountByEmail($email) {
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM Accounts WHERE email ='" . $email . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        return $result;
    }

    public function getAllAccounts() {
        $query = '';
        $accounts = array();
        try {
            $query ="SELECT * FROM Accounts";
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        return $accounts;
    }

    public function changePassword($id, $password){
        $query = '';
        $result = '';
        try {
            $query = "UPDATE Accounts SET password = '".md5($password)."' WHERE id = '".$id."'";
            $row = Config::$connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function deleteAccount($id){
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM Accounts WHERE id=".$id;
            $row = Config::$connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getLastFiveAccount() {
        $query = '';
        $accounts = array();
        try {
            $query ="SELECT * FROM Accounts ORDER BY id DESC LIMIT 5";
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        return $accounts;
    }

    public function getAccountByIdOrEmailOrShopName($keyword){
//        $keyword = "%".$keyword."%";
//        $query = '';
//        $accounts = array();
//        try {
//            $query = "SELECT * FROM Accounts INNER JOIN ShopInformations ON Accounts.id = ShopInformations.accounts_id WHERE Accounts.email LIKE " . $connection->quote($keyword) . " OR ShopInformations.name LIKE " . $connection->quote($keyword) . " OR Accounts.id LIKE " . $connection->quote($keyword) . " ORDER BY id DESC";
//            foreach(Config::$connection->query($query)->fetchAll() as $row){
//                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
//            }
//        }
//        catch(PDOException $e)
//        {
//            echo $query . "<br>" . $e->getMessage();
//        }
//        return $accounts;
    }
}

