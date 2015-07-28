<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/31/15 AD
 * Time: 11:54 PM
 */

class PromotionImageDAOImpl implements PromotionImageDAO {

    private $database_dns = 'mysql:host=127.0.0.1;dbname=WAP';
    private $database_username = 'root';
    private $database_password = '';

    public function addImage(PromotionImage $promotionImage)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO PromotionImage (promotion_id, image_path, add_date) VALUES (".$promotionImage->getPromotionId().", "
                .$connection->quote($promotionImage->getImagePath()).", '".$promotionImage->getAddDate()."')";
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

    public function getImageByPromotionId($promotionId)
    {
        $query = '';
        $result = '';
        $promotionImageList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM PromotionImage WHERE promotion_id=".$promotionId;
            foreach($connection->query($query)->fetchAll() as $row){
                $promotionImageList[] = new PromotionImage($row['id'], $row['promotion_id'], $row['image_path'], $row['add_date']);
            }
            $result = $promotionImageList;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }


    public function getImageById($id){
        $query = '';
        $result = '';
        $promotionImageList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM PromotionImage WHERE id ='" . $id . "'";
            $row = $connection->query($query)->fetch();
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
        $connection = null;
        return $result;
    }

    public function deleteImageByPromotionId($promotionId)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM PromotionImage WHERE promotion_id=".$promotionId;
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

    public function deleteImageById($id)
    {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM PromotionImage WHERE id=".$id;
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
}