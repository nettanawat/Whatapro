<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PromotionDAOImpl
 *
 * @author NetSmith
 */
class PromotionDAOImpl implements PromotionDAO{

    private $database_dns = 'mysql:host=127.0.0.1;dbname=WAP';
    private $database_username = 'root';
    private $database_password = '';

    public function addNewPromotion(Promotion $promotion) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO Promotions (shop_id, name , description, shared, start_date, end_date, status) VALUES ("
                .$promotion->getAccountId().", ".$connection->quote($promotion->getName()).", ".$connection->quote($promotion->getDescription()).
                ", ".$promotion->getShared().", '".$promotion->getStartDate()."', '".$promotion->getEndDate()."', ".$promotion->getStatus().")";
            $row = $connection->query($query);
            $result = $connection->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage() . "<br> :: Add Promotion";
            $result = null;
        }

        $connection = null;
        return $result;
    }

    public function deletePromotionByPromotionId($id) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM Promotions WHERE id=".$id;
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

    public function deletePromotionByShopId($shopId) {
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "DELETE FROM Promotions WHERE shop_id=".$shopId;
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

    public function getAllPromotions() {
        $query = '';
        $promotionList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Promotions";
            foreach($connection->query($query)->fetchAll() as $row){
                $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
        }

        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Get All Promotion";
        }
        $connection = null;
        return $promotionList;
    }

    public function getPromotionById($id){
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Promotions WHERE id ='" . $id . "'";
            $row = $connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage() . "<br> :: Get Promotion By Id";
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function editPromotion(Promotion $promotion){
        $query = '';
        $result = '';
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE Promotions SET name = ".$connection->quote($promotion->getName()).
                ", description=".$connection->quote($promotion->getDescription()).", start_date='".$promotion->getStartDate().
                "', end_date='".$promotion->getEndDate()."' WHERE id = ".$promotion->getPromotionId();
            $row = $connection->exec($query);
            $result = $row;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Edit Promotion";
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function getPromotionByShopId($id)
    {
        $query = '';
        $result = '';
        $promotionList = array();
        try {
            $connection = new PDO($this->database_dns, $this->database_username, $this->database_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query ="SELECT * FROM Promotions WHERE shop_id=".$id;
            foreach($connection->query($query)->fetchAll() as $row){
                $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
            $result = $promotionList;
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Get Promotion By Shop Id";
            $result = null;
        }
        $connection = null;
        return $result;
    }
}
