<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:00 PM
 */
include_once '../entity/AccountDAOImpl.php';
class AccountDAOImplTest extends PHPUnit_Framework_TestCase {
    public function testGetAccountByEmail(){
        SQLConnector::startConnection();
        $accountDAOImpl = new AccountDAOImpl();
        // test with email = admin1@wap.com
        $query = "SELECT * from Accounts WHERE email='admin1@wap.com'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $account = new AccountInfo($row['id'], $row['email'], $row['password'], $row['account_type'], $row['name'], $row['join_date'], $row['status']);
        $this->assertEquals($account, $accountDAOImpl->getAccountByEmail("admin1@wap.com"));
        //test with email=''
        $query = "SELECT * from Accounts WHERE email=''";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $account = new AccountInfo($row['id'], $row['email'], $row['password'], $row['account_type'], $row['name'], $row['join_date'], $row['status']);
//        $this->assertEquals($account, $accountDAOImpl->getAccountByEmail(""));
    }

}
 