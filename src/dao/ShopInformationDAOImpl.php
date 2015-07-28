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

    private $database_dns = 'mysql:host=127.0.0.1;dbname=WAP';
    private $database_username = 'root';
    private $database_password = '';

    public function addNewShopInformation(ShopInformation $shopInformation) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query ="INSERT INTO ShopInformations (accounts_id, name, address, phone_number, sub_district, latitude, longitude, open_time, description) ".
                " VALUES (".$shopInformation->getAccountId().", ".$connection->quote($shopInformation->getName()).", ".$connection->quote($shopInformation->getAddress()).", ".
                " '".$shopInformation->getPhoneNumber()."', '".$shopInformation->getSubDistrict()."', '".$shopInformation->getLatitude()."', '".$shopInformation->getLongitude()."', ".
                " ".$connection->quote($shopInformation->getOpenTime()).", ".$connection->quote($shopInformation->getDescription()).")";
            $row = $connection->query($query);
            $result = $shopInformation->getAccountId();
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }

        $connection = null;
        return $result;
    }

    public function deleteShopInformation($id) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM ShopInformations WHERE accounts_id=".$id;
            $row = $connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function editShopInformation(ShopInformation $shopInformation) {

        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE ShopInformations SET name = ".$connection->quote($shopInformation->getName()).", address = ".$connection->quote($shopInformation->getAddress()).",
          phone_number = '".$shopInformation->getPhoneNumber()."', latitude = '".$shopInformation->getLatitude()."', longitude = '".$shopInformation->getLongitude()."',
          open_time = ".$connection->quote($shopInformation->getOpenTime()).", description = ".$connection->quote($shopInformation->getDescription()).", category = '".$shopInformation->getCategory()."'
          WHERE accounts_id = '".$shopInformation->getAccountId()."'";
            $row = $connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function getAllShopInformation() {

        $query = '';
        $shopInformationList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM ShopInformations";
            foreach($connection->query($query)->fetchAll() as $row){
                $shopInformationList[] = new ShopInformation($row['accounts_id'], $row['name'], $row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['category']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        $connection = null;
        return $shopInformationList;
    }

    public function getShopInformationById($id){
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM ShopInformations WHERE accounts_id ='" . $id . "'";
            $row = $connection->query($query)->fetch();
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
        $connection = null;
        return $result;
    }
}
