<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author NetSmith
 */
class SQLConnector {


    static private $connect = null;

    static function startConnection() {
        self::$connect = mysql_connect("127.0.0.1", "root", "") or die("Can't connect to database!");
        mysql_select_db("WAP", self::$connect) or die("Can't connect to WAP");
    }

    static function closeConnection() {
        mysql_close(self::$connect);
    }

    static function insertDataIntoDatabase($table, $columnNames, $columnValues) {
        SQLConnector::startConnection();
        $sql = "";
        for ($i = 0; $i < sizeof($columnNames); $i++) {
            if ($i == 0) {
                $sql = "INSERT INTO " . $table . " (" . $columnNames[$i] . ", ";
            } else if ($i == (sizeof($columnNames) - 1)) {
                $sql = $sql . $columnNames[$i] . ") VALUES ('";
            } else {
                $sql = $sql . $columnNames[$i] . ", ";
            }
        }

        for ($i = 0; $i < sizeof($columnValues); $i++) {
            if ($i < (sizeof($columnValues) - 1)) {
                $sql = $sql . $columnValues[$i] . "', '";
            } else if ($i == (sizeof($columnValues) - 1)) {
                $sql = $sql . $columnValues[$i] . "')";
            } else {
                
            }
        }
        if (!mysql_query($sql, self::$connect)) {
            die('Error: ' . $table . " and :: " . mysql_error(self::$connect));
        }
    }

    static function getDataFromTable($tableName) {
        SQLConnector::startConnection();
        if ("Accounts" == $tableName) {
            $query = "SELECT * FROM Accounts";
            $result = mysql_query($query);
            $accountList = array();
            while ($row = mysql_fetch_array($result)) {
                $accountList[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['account_type'], $row['name'], $row['join_date'], $row['status']);
            }
            return $accountList;
        } else if ("Promotions" == $tableName) {
            $query = "SELECT * FROM Promotions";
            $result = mysql_query($query);
            $promotionList = array();
            while ($row = mysql_fetch_array($result)) {
                $promotionList[] = new Promotion($row['id'], $row['accounts_id'], $row['name'], $row['description'], $row['img'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
            return $promotionList;
        } else if ("RequestingSignup" == $tableName) {
            $query = "SELECT * FROM RequestingSignup";
            $result = mysql_query($query);
            $requestingSignupList = array();
            while ($row = mysql_fetch_array($result)) {
                $requestingSignupList[] = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'], $row['image'], $row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
            }
            return $requestingSignupList;
        } else if ("ShopInformations" == $tableName) {
            $query = "SELECT * FROM ShopInformations";
            $result = mysql_query($query);
            $shopInformationsList = array();
            while ($row = mysql_fetch_array($result)) {
                $shopInformationsList[] = new ShopInformation($row['id'], $row['accounts_id'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['image']);
            }
            return $shopInformationsList;
        } else if("Logs" == $tableName){
            $query = "SELECT * FROM Logs";
            $result = mysql_query($query);
            $logList = array();
            while ($row = mysql_fetch_array($result)) {
                $logList[] = new ActivitiesLog($row['account_id'], $row['action'], $row['action_detail'], $row['date'], $row['id'], $row['title']);
            }
            return $logList;
        }
    }

    static  function isDuplicate($tableName, $conditionName, $conditionValue) {
        SQLConnector::startConnection();
        $query = mysql_query("SELECT * FROM " . $tableName . " WHERE " . $conditionName . "='$conditionValue'");
        $numrows = mysql_num_rows($query);
        if ($numrows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function disableARow($tableName, $condition) {
        SQLConnector::startConnection();
        $queryString = "UPDATE `" . $tableName . "` SET `status`=2 WHERE `id`=" . $condition;
        mysql_query($queryString);
    }

    static function enableARow($tableName, $condition) {
        SQLConnector::startConnection();
        $queryString = "UPDATE `" . $tableName . "` SET `status`=1 WHERE `id`=" . $condition;
        mysql_query($queryString);
    }

    public function updateStatusDataToDatabase($tablename, $id) {
        SQLConnector::startConnection();
        if ("Accounts" == $tablename) {
            
        } else if ("Promotions" == $tablename) {
            
        } else if ("RequestingSignup" == $tablename) {
            $queryString = "UPDATE `RequestingSignup` SET `status`=1 WHERE `id`=".$id;
            mysql_query($queryString);
        }
    }

    public function updatePromotionTable(Promotion $promotion){
        SQLConnector::startConnection();
        $queryString = "UPDATE `Promotions` SET name='".$promotion->getName()."', description='".$promotion->getDescription().
            "', img='".$promotion->getImg()."', start_date='".$promotion->getStartDate()."', end_date='".$promotion->getEndDate()."' WHERE id=".$promotion->getPromotionId();
        mysql_query($queryString);
    }

    static function updateAccountTable(AccountInfo $accountInfo){
        SQLConnector::startConnection();
        $queryString1 = "UPDATE `Accounts` SET email='".$accountInfo->getEmail()."', name='".$accountInfo->getName().
            "' WHERE id=".$accountInfo->getAccountId();
        mysql_query($queryString1);
    }

    static function updatePassword($password, $id){
        SQLConnector::startConnection();
        $queryString = "UPDATE `Accounts` SET password='".$password."'WHERE id=".$id;
        mysql_query($queryString);
    }

    static function updateShopInformationTable(ShopInformation $shopInformation, $accountId){
        SQLConnector::startConnection();
        $queryString2 ="UPDATE `Shopinformations` SET phone_number='".$shopInformation->getPhoneNumber()."', sub_district='".$shopInformation->getSubDistrict().
            "', latitude='".$shopInformation->getLatitude()."', longitude='".$shopInformation->getLongitude()."', open_time='".$shopInformation->getOpenTime()."', description='".$shopInformation->getDescription()."' WHERE accounts_id=".$accountId;
        mysql_query($queryString2);
    }
}

?>
