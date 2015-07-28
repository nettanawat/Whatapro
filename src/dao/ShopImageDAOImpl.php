<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 8:05 PM
 */

class ShopImageDAOImpl implements ShopImageDAO {

    private $database_dns = 'mysql:host=127.0.0.1;dbname=WAP';
    private $database_username = 'root';
    private $database_password = '';

    public function addImage(ShopImage $shopImage)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO ShopImage (shop_id, image_path, added_date) VALUES (".$shopImage->getShopId().", "
                .$connection->quote($shopImage->getImagePath()).", '".$shopImage->getAddDate()."')";
            $row = $connection->query($query);
            $result = $connection->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function deleteImageByShopId($shopId)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM ShopImage WHERE shop_id=".$shopId;
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

    public function getImageByAccountId($accountId){
        $query = '';
        $result = '';
        $shopImageList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM ShopImage WHERE shop_id=".$accountId;
            foreach($connection->query($query)->fetchAll() as $row){
                $shopImageList[] = new ShopImage($row['id'], $row['shop_id'], $row['image_path'], $row['added_date']);
            }
            $result = $shopImageList;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function deleteImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM ShopImage WHERE id=".$id;
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

    public function getImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM ShopImage WHERE id ='" . $id . "'";
            $row = $connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new ShopImage($row['id'], $row['shop_id'], $row['image_path'], $row['added_date']);
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
