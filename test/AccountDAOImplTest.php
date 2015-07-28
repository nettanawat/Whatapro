<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:00 PM
 */
include dirname(__FILE__) . '/../Config.php';
class AccountDAOImplTest extends PHPUnit_Framework_TestCase {

    public function testDoLogin() {
        $accountDaoImpl = new AccountDAOImpl();
        $loggedInAccount1 = $accountDaoImpl->doLogin('admin1@gmail.com', '1234');
        $loggedInAccount2 = $accountDaoImpl->doLogin('admin2@gmail.com', '1234');
        $loggedInAccount3 = $accountDaoImpl->doLogin('admin3@gmail.com', '1234');
        $loggedInAccount4 = $accountDaoImpl->doLogin('iamadmin@gmail.com', '1234');
        $loggedInAccount5 = $accountDaoImpl->doLogin('iamfuckingadmin@gmail.com', '1234');
        $account1 = new AccountInfo(10, 'admin1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account2 = new AccountInfo(11, 'admin2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account3 = new AccountInfo(12, 'admin3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account4 = new AccountInfo(13, 'iamadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account5 = new AccountInfo(14, 'iamfuckingadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $this->assertEquals($account1, $loggedInAccount1);
        $this->assertEquals($account2, $loggedInAccount2);
        $this->assertEquals($account3, $loggedInAccount3);
        $this->assertEquals($account4, $loggedInAccount4);
        $this->assertEquals($account5, $loggedInAccount5);
    }

//    public function testAddNewAccount() {
//        $accountDaoImpl = new AccountDAOImpl();
//        $account1 = new AccountInfo(10, 'aaaa@gmail.com', '1234', 'admin', '2015-07-23 00:00:00', 1);
//        $account2 = new AccountInfo(11, 'bbbb@gmail.com', '1234', 'admin', '2015-07-23 00:00:00', 1);
//        $account3 = new AccountInfo(12, 'cccc@gmail.com', '1234', 'admin', '2015-07-23 00:00:00', 1);
//        $account4 = new AccountInfo(13, 'dddd@gmail.com', '1234', 'admin', '2015-07-23 00:00:00', 1);
//        $account5 = new AccountInfo(14, 'eeee@gmail.com', '1234', 'admin', '2015-07-23 00:00:00', 1);
//        $this->assertEquals(73, $accountDaoImpl->addNewAccount($account1));
//        $this->assertEquals(73, $accountDaoImpl->addNewAccount($account2));
//        $this->assertEquals(73, $accountDaoImpl->addNewAccount($account3));
//        $this->assertEquals(73, $accountDaoImpl->addNewAccount($account4));
//        $this->assertEquals(73, $accountDaoImpl->addNewAccount($account5));
//    }

    public function testGetAccountById() {
        $accountDaoImpl = new AccountDAOImpl();
        $account1 = new AccountInfo(10, 'admin1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account2 = new AccountInfo(11, 'admin2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account3 = new AccountInfo(12, 'admin3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account4 = new AccountInfo(13, 'iamadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account5 = new AccountInfo(14, 'iamfuckingadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $this->assertEquals($account1, $accountDaoImpl->getAccountById(10));
        $this->assertEquals($account2, $accountDaoImpl->getAccountById(11));
        $this->assertEquals($account3, $accountDaoImpl->getAccountById(12));
        $this->assertEquals($account4, $accountDaoImpl->getAccountById(13));
        $this->assertEquals($account5, $accountDaoImpl->getAccountById(14));
    }

    public function testGetAccountByEmail() {
        $accountDaoImpl = new AccountDAOImpl();
        $account1 = new AccountInfo(10, 'admin1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account2 = new AccountInfo(11, 'admin2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account3 = new AccountInfo(12, 'admin3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account4 = new AccountInfo(13, 'iamadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $account5 = new AccountInfo(14, 'iamfuckingadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-07-23 00:00:00', 1);
        $this->assertEquals($account1, $accountDaoImpl->getAccountByEmail("admin1@gmail.com"));
        $this->assertEquals($account2, $accountDaoImpl->getAccountByEmail("admin2@gmail.com"));
        $this->assertEquals($account3, $accountDaoImpl->getAccountByEmail("admin3@gmail.com"));
        $this->assertEquals($account4, $accountDaoImpl->getAccountByEmail("iamadmin@gmail.com"));
        $this->assertEquals($account5, $accountDaoImpl->getAccountByEmail("iamfuckingadmin@gmail.com"));
    }

    public function testGetAllAccount() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals(31, sizeof($accountDaoImpl->getAllAccounts()));
    }

    public function testChangePassword(){
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals(1, $accountDaoImpl->changePassword(10, "1111"));
        $this->assertEquals(1, $accountDaoImpl->changePassword(11, "1111"));
        $this->assertEquals(1, $accountDaoImpl->changePassword(12, "1111"));
        $this->assertEquals(0, $accountDaoImpl->changePassword(100, "1111"));
        $this->assertEquals(0, $accountDaoImpl->changePassword(-1, "1111"));
    }

    public function testDeleteAccount() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(10));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(11));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(12));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(13));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(14));
    }
}
