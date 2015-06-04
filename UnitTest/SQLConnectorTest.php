<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 8/11/14 AD
 * Time: 12:58 PM
 */
include_once '../Library/SQLConnector.php';
include_once '../entity/AccountInfo.php';
include_once '../entity/Promotion.php';
class SQLConnectorTest extends PHPUnit_Framework_TestCase {

    public function testInsertDateIntoDatabase(){
        // create connection
        SQLConnector::startConnection();
        // check in DB if data exists
        $query = "SELECT * from Accounts WHERE email='ssssss@gmail.com'";
        $executeQuery = mysql_query($query);
        $numRows = mysql_num_rows($executeQuery);
        $this->assertEquals(0, $numRows);

        $account1 = new AccountInfo(null, "ssssss@gmail.com", "1234", 1, "test unit", "2014-07-07",1);
        $columnNamesAccount = array();
        $columnNamesAccount[] = "email";
        $columnNamesAccount[] = "password";
        $columnNamesAccount[] = "account_type";
        $columnNamesAccount[] = "name";
        $columnNamesAccount[] = "join_date";
        $columnNamesAccount[] = "status";
        /** values **/
        $columnValuesAccount = array();
        $columnValuesAccount[] = $account1->getEmail();
        $columnValuesAccount[] = md5($account1->getPassword());
        $columnValuesAccount[] = $account1->getAccountType();
        $columnValuesAccount[] = $account1->getName();
        $columnValuesAccount[] = $account1->getJoinDate();
        $columnValuesAccount[] = $account1->getStatus();
        SQLConnector::insertDataIntoDatabase("Accounts", $columnNamesAccount, $columnValuesAccount);

        $query = "SELECT * FROM Accounts ORDER BY id DESC LIMIT 1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $this->assertEquals("ssssss@gmail.com", $row['email']);
        mysql_query("DELETE FROM Accounts WHERE email='ssssss@gmail.com'");
    }

    public function testDisableRowAndEnableRow(){
        //disable
        $sqlConnector = new SQLConnector();
        $sqlConnector->disableARow("Promotions", 1);
        $query = "SELECT * from Promotions WHERE id=1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $this->assertEquals(2, $row['status']);
        //enable
        SQLConnector::enableARow("Promotions", 1);
        $query = "SELECT * from Promotions WHERE id=1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $this->assertEquals(1, $row['status']);
    }

    public function testGetDataFromDataBase(){
        // Accounts
        $accountList = SQLConnector::getDataFromTable("Accounts");
        $this->assertEquals("admin1@wap.com", $accountList[0]->getEmail());
        $this->assertEquals("admin2@wap.com", $accountList[1]->getEmail());
        $this->assertEquals("dermderm@wap.com", $accountList[2]->getEmail());
        $this->assertEquals("doodeebar@wap.com", $accountList[3]->getEmail());
        $this->assertEquals("caferoubaix@gmail.com", $accountList[4]->getEmail());

        // Promotions
        $promotionList = SQLConnector::getDataFromTable("Promotions");
        $this->assertEquals("Lady night for member", $promotionList[0]->getName());
        $this->assertEquals("Free bar na", $promotionList[1]->getName());
        $this->assertEquals("Free bar", $promotionList[2]->getName());
        $this->assertEquals("Free free", $promotionList[3]->getName());
    }

    public function testUpdatePromotionTable(){
        $promotion = new Promotion(1, 101, "Lady night for member", "This promotoin for only member", null,null,"2014-07-18", "2014-08-02", 1);
        $sqlConnector = new SQLConnector();
        $sqlConnector->updatePromotionTable($promotion);
        $query = "SELECT * from Promotions WHERE id=1";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $this->assertEquals("This promotoin for only member", $row[description]);
        $this->assertEquals("Lady night for member", $row[name]);
        $this->assertEquals("2014-07-18", $row[start_date]);
        $this->assertEquals("2014-08-02", $row[end_date]);
        $this->assertEquals(1, $row[status]);
    }
}
 