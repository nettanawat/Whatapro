<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 8:05 PM
 */

class ShopImageDAOImpl implements ShopImageDAO {

    public function addImage(ShopImage $shopImage)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id FROM ShopImage ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = '';
            if($lastId == false) {
                $id = 1;
            } else {
                $id = $lastId['id']+1;
            }
            $query = "INSERT INTO ShopImage (id, shop_id, image_path, added_date) VALUES (".$id.", "
                .$shopImage->getShopId().", ".Config::$connection->quote($shopImage->getImagePath()).", '".$shopImage->getAddDate()."')";
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

    public function deleteImageByShopId($shopId)
    {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM ShopImage WHERE shop_id=".$shopId;
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

    public function getImageByAccountId($accountId){
        $query = '';
        $result = '';
        $shopImageList = array();
        try {
            $query ="SELECT * FROM ShopImage WHERE shop_id=".$accountId;
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $shopImageList[] = new ShopImage($row['id'], $row['shop_id'], $row['image_path'], $row['added_date']);
            }
            $result = $shopImageList;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function deleteImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM ShopImage WHERE id=".$id;
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

    public function getImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM ShopImage WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
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
        return $result;
    }
}
