<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/31/15 AD
 * Time: 11:54 PM
 */

class PromotionImageDAOImpl implements PromotionImageDAO {

    public function addImage(PromotionImage $promotionImage)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id FROM PromotionImage ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = '';
            if($lastId == false) {
                $id = 1;
            } else {
                $id = $lastId['id']+1;
            }
            $query = "INSERT INTO PromotionImage (id, promotion_id, image_path, add_date) VALUES (".$id.", "
                .$promotionImage->getPromotionId().", ".Config::$connection->quote($promotionImage->getImagePath()).", '".$promotionImage->getAddDate()."')";
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

    public function getImageByPromotionId($promotionId)
    {
        $query = '';
        $result = '';
        $promotionImageList = array();
        try {
            $query ="SELECT * FROM PromotionImage WHERE promotion_id=".$promotionId;
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $promotionImageList[] = new PromotionImage($row['id'], $row['promotion_id'], $row['image_path'], $row['add_date']);
            }
            $result = $promotionImageList;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getImageById($id){
        $query = '';
        $result = '';
        $promotionImageList = array();
        try {
            $query ="SELECT * FROM PromotionImage WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new PromotionImage($row['id'], $row['promotion_id'], $row['image_path'], $row['add_date']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function deleteImageByPromotionId($promotionId)
    {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM PromotionImage WHERE promotion_id=".$promotionId;
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

    public function deleteImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM PromotionImage WHERE id=".$id;
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
}