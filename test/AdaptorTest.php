<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 12:42 PM
 */
//include_once '../Config.php';

include_once '../Library/Adaptor.php';
class AdaptorTest extends PHPUnit_Framework_TestCase {
    public function testGetStatus(){
        $adaptor =new Adaptor();
        $adaptor->setStatus(0);
        $this->assertEquals('inactive', $adaptor->getStatus());
        $adaptor->setStatus(1);
        $this->assertEquals('active', $adaptor->getStatus());
        $adaptor->setStatus(2);
        $this->assertEquals('waiting', $adaptor->getStatus());
    }

    public function testGetAccountType(){
        $adaptor =new Adaptor();
        $adaptor->setAccountType(0);
        $this->assertEquals('admin', $adaptor->getAccountType());
        $adaptor->setAccountType(1);
        $this->assertEquals('user', $adaptor->getAccountType());
    }

    public function testGetSubDistrict(){
        $adaptor =new Adaptor();
        $adaptor->setSubDistrict(1);
        $this->assertEquals('Suthep', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(2);
        $this->assertEquals('Nai Maung', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(3);
        $this->assertEquals('Si Phum', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(4);
        $this->assertEquals('Phra Sing', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(5);
        $this->assertEquals('Chang Phueak', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(6);
        $this->assertEquals('Mae Hia', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(7);
        $this->assertEquals('Pa Daet', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(8);
        $this->assertEquals('Pa Tan', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(9);
        $this->assertEquals('Chang Moi', $adaptor->getSubDistrict());
        $adaptor->setSubDistrict(10);
        $this->assertEquals('Chang Khlan', $adaptor->getSubDistrict());
    }
}
 