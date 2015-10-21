<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShopInformationDAOImpl
 *
 * @author NetSmith
 */
class ShopInformationDAOImpl implements ShopInformationDAO {

    public function addNewShopInformation(ShopInformation $shopInformation) {
        $query = '';
        $result = '';
        try {
            $query ="INSERT INTO ShopInformations (accounts_id, name, address, phone_number, sub_district, latitude, longitude, open_time, description) ".
                " VALUES (".$shopInformation->getAccountId().", ".Config::$connection->quote($shopInformation->getName()).", ".Config::$connection->quote($shopInformation->getAddress()).", ".
                " '".$shopInformation->getPhoneNumber()."', '".$shopInformation->getSubDistrict()."', '".$shopInformation->getLatitude()."', '".$shopInformation->getLongitude()."', ".
                " ".Config::$connection->quote($shopInformation->getOpenTime()).", ".Config::$connection->quote($shopInformation->getDescription()).")";
            $row = Config::$connection->query($query);
            $result = Config::$connection->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function deleteShopInformation($id) {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM ShopInformations WHERE accounts_id=".$id;
            $row = Config::$connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function editShopInformation(ShopInformation $shopInformation) {
        $query = '';
        $result = '';
        try {
            $query = "UPDATE ShopInformations SET name = ".Config::$connection->quote($shopInformation->getName()).", address = ".Config::$connection->quote($shopInformation->getAddress()).",
          phone_number = '".$shopInformation->getPhoneNumber()."', latitude = '".$shopInformation->getLatitude()."', longitude = '".$shopInformation->getLongitude()."',
          open_time = ".Config::$connection->quote($shopInformation->getOpenTime()).", description = ".Config::$connection->quote($shopInformation->getDescription()).", category = '".$shopInformation->getCategory()."'
          WHERE accounts_id = '".$shopInformation->getAccountId()."'";
            $row = Config::$connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getAllShopInformation() {
        $query = '';
        $shopInformationList = array();
        try {
            $query ="SELECT * FROM ShopInformations";
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $shopInformationList[] = new ShopInformation($row['accounts_id'], $row['name'], $row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['category']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        return $shopInformationList;
    }

    public function getShopInformationById($id){
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM ShopInformations WHERE accounts_id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new ShopInformation($row['accounts_id'], $row['name'], $row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['category']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }
}
