<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:00 PM
 */

include dirname(__FILE__) . '/../Config.php';
class AccountDAOImplTest extends PHPUnit_Framework_TestCase {

    private $account1 = '';
    private $account2 = '';
    private $account3 = '';
    private $account4 = '';
    private $account5 = '';
    private $account6 = '';
    private $account7 = '';
    private $account8 = '';
    private $account9 = '';
    private $account10 = '';
    private $account11 = '';

    public function setUp(){
        $this->account1 = new AccountInfo(2, 'admin1@gmail.com', md5(1234), 'admin', '2015-08-08 00:00:00', 1);
        $this->account2 = new AccountInfo(3, 'admin2@gmail.com', md5(1234), 'admin', '2015-08-08 00:00:00', 1);
        $this->account3 = new AccountInfo(4, 'admin3@gmail.com', md5(1234), 'admin', '2015-08-08 00:00:00', 1);
        $this->account4 = new AccountInfo(5, 'iamadmin@gmail.com', md5(1234), 'admin', '2015-08-08 00:00:00', 1);
        $this->account5 = new AccountInfo(6, 'camp@gmail.com', md5("1234"), 'user', '2015-08-08 13:00:09', 1);
        $this->account6 = new AccountInfo(7, 'coffeeman@gmail.com', md5("1234"), 'user', '2015-08-08 13:04:16', 1);
        $this->account7 = new AccountInfo(8, 'warmup@gmail.com', md5("1234"), 'user', '2015-08-08 13:07:39', 1);
        $this->account8 = new AccountInfo(9, 'coffeesmith@gmail.com', md5("1234"), 'user', '2015-08-08 13:10:47', 1);
        $this->account9 = new AccountInfo(10, 'ohyeah@gmail.com', md5("1234"), 'user', '2015-08-08 13:10:47', 1);
        $this->account10 = new AccountInfo(11, 'whatttt@gmail.com', md5("1234"), 'user', '2015-08-08 13:10:47', 1);
        $this->account11 = new AccountInfo(12, 'damnnnn@gmail.com', md5("1234"), 'user', '2015-08-08 13:10:47', 1);
    }

    public function testDoLogin() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals($this->account1, $accountDaoImpl->doLogin('admin1@gmail.com', '1234'));
        $this->assertEquals(null, $accountDaoImpl->doLogin('admin1@gmail.com', '1111'));
        $this->assertEquals(null, $accountDaoImpl->doLogin('test@wap.com', 'test'));
        $this->assertEquals(null, $accountDaoImpl->doLogin('admin1', '1234'));
    }

    public function testAddNewAccount() {
        $accountDaoImpl = new AccountDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(100, $accountDaoImpl->addNewAccount(new AccountInfo(100, "warmup@gmail.com", "1234", "user", "2015-08-08 13:10:47", 1)));
        $this->assertEquals(101, $accountDaoImpl->addNewAccount(new AccountInfo(101, "heywap@gmail.com", "1111", "user", "2015-08-08 13:10:47", 1)));
        $this->assertEquals(102, $accountDaoImpl->addNewAccount(new AccountInfo(102, "ohman@gmail.com", "4321", "user", "2015-08-08 13:10:47", 1)));
    }

    public function testGetAccountById() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals($this->account1, $accountDaoImpl->getAccountById(2));
        $this->assertEquals($this->account2, $accountDaoImpl->getAccountById(3));
        $this->assertEquals($this->account3, $accountDaoImpl->getAccountById(4));
        $this->assertEquals(null, $accountDaoImpl->getAccountById(100));
    }

    public function testGetAccountByEmail() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals($this->account1, $accountDaoImpl->getAccountByEmail("admin1@gmail.com"));
        $this->assertEquals($this->account2, $accountDaoImpl->getAccountByEmail("admin2@gmail.com"));
        $this->assertEquals(null, $accountDaoImpl->getAccountByEmail("wishmeluck@gmail.com"));
        $this->assertEquals(null, $accountDaoImpl->getAccountByEmail("admin"));
    }

    public function testGetAllAccount() {
        $accountDaoImpl = new AccountDAOImpl();
        $this->assertEquals(9, sizeof($accountDaoImpl->getAllAccounts()));
    }

    public function testChangePassword(){
        $accountDaoImpl = new AccountDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $accountDaoImpl->changePassword(1, "1111"));
        $this->assertEquals(1, $accountDaoImpl->changePassword(2, "1111"));
        $this->assertEquals(0, $accountDaoImpl->changePassword(100, "1234"));
        $this->assertEquals(0, $accountDaoImpl->changePassword(-100, "4444"));
    }

    public function testDeleteAccount() {
        $accountDaoImpl = new AccountDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(2));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(3));
        $this->assertEquals(1, $accountDaoImpl->deleteAccount(4));
        $this->assertEquals(0, $accountDaoImpl->deleteAccount(100));
    }

    public function tearDown(){
        if(Config::$connection->inTransaction()){
            Config::$connection->rollBack();
        }
    }

}