<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:00 PM
 */
include dirname(__FILE__) . '/../Config.php';

class AccountDAOImplTest extends PHPUnit_Framework_TestCase
{
    public function testDoLogin()
    {
        $accountDaoImpl = new AccountDAOImpl();
        $loggedInAccount = $accountDaoImpl->doLogin('admin@wap.com', '81dc9bdb52d04dc20036dbd8313ed055');
        $this->assertEquals($loggedInAccount, new AccountInfo(1, 'admin@wap.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-06-19 00:00:00', 1));
    }
}
