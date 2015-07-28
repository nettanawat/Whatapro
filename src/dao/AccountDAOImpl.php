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

//include_once 'AccountDAO.php';
//include_once dirname(__FILE__).'/../entity/AccountInfo.php';
class AccountDAOImpl implements AccountDAO {

    private $database_dns = 'mysql:host=127.0.0.1;dbname=WAP';
    private $database_username = 'root';
    private $database_password = '';

    public function doLogin($email, $password){

        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Accounts WHERE email = '".$email."' AND password ='".md5($password)."'";

            $row = $connection->query($query)->fetch();
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

        $connection = null;
        return $result;
    }

    public function addNewAccount(AccountInfo $account) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="INSERT INTO Accounts (email, password, role, join_date, status) VALUES ('".$account->getEmail()."', '".$account->getPassword()."', '".$account->getRole()."', '".$account->getJoinDate()."', 1)";
            $row = $connection->query($query);
            $result = $connection->lastInsertId();
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
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Accounts WHERE id ='" . $id . "'";
            $row = $connection->query($query)->fetch();
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
        $connection = null;
        return $result;
    }

    public function getAccountByEmail($email) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Accounts WHERE email ='" . $email . "'";
            $row = $connection->query($query)->fetch();
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
        $connection = null;
        return $result;
    }

    public function getAllAccounts() {
        $query = '';
        $accounts = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Accounts";
            foreach($connection->query($query)->fetchAll() as $row){
                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        $connection = null;
        return $accounts;
    }

    public function changePassword($id, $password){
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE Accounts SET password = '".md5($password)."' WHERE id = '".$id."'";
            $row = $connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function deleteAccount($id){
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM Accounts WHERE id=".$id;
            $row = $connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function getLastFiveAccount() {
        $query = '';
        $accounts = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Accounts ORDER BY id DESC LIMIT 5";
            foreach($connection->query($query)->fetchAll() as $row){
                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        $connection = null;
        return $accounts;
    }
    public function getAccountByIdOrEmailOrShopName($keyword){
        $keyword = "%".$keyword."%";
        $query = '';
        $accounts = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM Accounts INNER JOIN ShopInformations ON Accounts.id = ShopInformations.accounts_id WHERE Accounts.email LIKE " . $connection->quote($keyword) . " OR ShopInformations.name LIKE " . $connection->quote($keyword) . " OR Accounts.id LIKE " . $connection->quote($keyword) . " ORDER BY id DESC";
            foreach($connection->query($query)->fetchAll() as $row){
                $accounts[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        $connection = null;
        return $accounts;
    }
}

