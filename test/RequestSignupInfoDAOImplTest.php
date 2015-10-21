<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 10/21/15 AD
 * Time: 6:57 PM
 */

include dirname(__FILE__) . '/../Config.php';

class RequestSignupInfoDAOImplTest extends PHPUnit_Framework_TestCase {

    private $request1 = '';
    private $request2 = '';
    private $request3 = '';

    public function setUp(){
        $this->request1 = new RequestSignupInfo(1, "chill@gmail.com", "1111", "chill", "40 Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200", "053333333", 7, 18.7898863455, 98.9714527130, "every day", "this is really good place", "2015-10-20 10:54:56", null, null, 2);
        $this->request2 = new RequestSignupInfo(2, "w33@gmail.com", "1111", "w33", "696 Moo 15, Tumbol Booheaw", "053333333", 1, 18.7887081230, 98.9714527130, "every day", "the best place in cm", "2015-10-20 10:54:56", null, null, 2);
        $this->request3 = new RequestSignupInfo(3, "goodbar@gmail.com", "1111", "good bar", "696 Moo 15, Tumbol Booheaw", "053333333", 7, 18.7889518939, 98.9734268188, "every day", "come to visit us", "2015-10-20 12:41:44", null, null, 2);
    }

    public function testAddNewRequest(){
        $requestSignupInfoDaoImpl = new RequestSignupInfoDAOImpl();
        Config::$connection->beginTransaction();
        $this->assertEquals(1, $requestSignupInfoDaoImpl->addNewRequest($this->request1));
        $this->assertEquals(2, $requestSignupInfoDaoImpl->addNewRequest($this->request2));
        $this->assertEquals(3, $requestSignupInfoDaoImpl->addNewRequest($this->request3));
        Config::$connection->rollBack();
    }

    public function testGetRequestSignupById (){
        $requestSignupInfoDaoImpl = new RequestSignupInfoDAOImpl();
        Config::$connection->beginTransaction();
        $requestSignupInfoDaoImpl->addNewRequest($this->request1);
        $requestSignupInfoDaoImpl->addNewRequest($this->request2);
        $requestSignupInfoDaoImpl->addNewRequest($this->request3);
        $this->assertEquals($this->request1, $requestSignupInfoDaoImpl->getRequestSignupById(1));
        $this->assertEquals($this->request2, $requestSignupInfoDaoImpl->getRequestSignupById(2));
        $this->assertEquals($this->request3, $requestSignupInfoDaoImpl->getRequestSignupById(3));
        $this->assertEquals(null, $requestSignupInfoDaoImpl->getRequestSignupById(100));
        Config::$connection->rollBack();
    }

    public function testUpdateRequestStatus  (){
        $requestSignupInfoDaoImpl = new RequestSignupInfoDAOImpl();
        Config::$connection->beginTransaction();
        $requestSignupInfoDaoImpl->addNewRequest($this->request1);
        $requestSignupInfoDaoImpl->addNewRequest($this->request2);
        $requestSignupInfoDaoImpl->addNewRequest($this->request3);
        $this->assertEquals(1, $requestSignupInfoDaoImpl->updateRequestStatus(1, 1, 1));
        $this->assertEquals(1, $requestSignupInfoDaoImpl->updateRequestStatus(2, 1, 1));
        $this->assertEquals(1, $requestSignupInfoDaoImpl->updateRequestStatus(3, 1, 1));
        $this->assertEquals(0, $requestSignupInfoDaoImpl->updateRequestStatus(100, 1, 2));
        Config::$connection->rollBack();
    }

} 