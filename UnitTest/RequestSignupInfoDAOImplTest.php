<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 4:40 PM
 */
include_once '../entity/RequestSignupInfoDAOImpl.php';
include_once '../Library/SQLConnector.php';
class RequestSignupInfoDAOImplTest extends PHPUnit_Framework_TestCase {
    public function testGetRequesSignupById(){
            $requestingSignup = new RequestSignupInfoDAOImpl();
            // test with id = 1
            SQLConnector::startConnection();
            $query = "SELECT * from RequestingSignup WHERE id=1";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            $request = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'], $row['image'], $row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
            $this->assertEquals($request, $requestingSignup->getRequesSignupById(1));

            $query = "SELECT * from RequestingSignup WHERE id=2";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            $request = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'], $row['image'], $row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
            $this->assertEquals($request, $requestingSignup->getRequesSignupById(2));
    }

    public function testGetRequesSignupByStatus(){
        $requestingSignup = new RequestSignupInfoDAOImpl();
        // test with id = 1
        $query = "SELECT * from RequestingSignup WHERE status=1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $request = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'], $row['image'], $row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
        $this->assertEquals($request, $requestingSignup->getRequestByStatus(1));

        $query = "SELECT * from RequestingSignup WHERE status=2";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $request = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'], $row['image'], $row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
        $this->assertEquals($request, $requestingSignup->getRequestByStatus(2));
    }
}
 