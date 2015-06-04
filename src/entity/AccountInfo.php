<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author NetSmith
 */
class AccountInfo {

    //put your code here
    private $accountId;
    private $email;
    private $password;
    private $role;
    private $joinDate;
    private $status;

    public function AccountInfo($accountId, $email, $password,$role, $joinDate, $status) {
        $this->accountId = $accountId;
        $this->email = $email;
        $this->password = $password;
        $this->role=$role;
        $this->joinDate=$joinDate;
        $this->status=$status;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    
    public function getJoinDate() {
        return $this->joinDate;
    }

    public function setJoinDate($joinDate) {
        $this->joinDate = $joinDate;
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}

?>
