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

    public function addNewPromotion(Promotion $promotion) {
        $query = '';
        $result = '';
        try {
            $id = '';
            if($promotion->getPromotionId() == null){
                $queryGetId ="SELECT id FROM Promotions ORDER BY id DESC LIMIT 1";
                $lastId = Config::$connection->query($queryGetId)->fetch();
                if($lastId == false) {
                    $id = 1;
                } else {
                    $id = $lastId['id']+1;
                }
            } else {
                $id = $promotion->getPromotionId();
            }

            $query = "INSERT INTO Promotions (id, shop_id, name , description, shared, start_date, end_date, status) VALUES (".$id.", "
                .$promotion->getAccountId().", ".Config::$connection->quote($promotion->getName()).", ".Config::$connection->quote($promotion->getDescription()).
                ", ".$promotion->getShared().", '".$promotion->getStartDate()."', '".$promotion->getEndDate()."', ".$promotion->getStatus().")";
            $row = Config::$connection->query($query);
            $result = Config::$connection->lastInsertId();
        } catch(PDOException $e) {
            echo $query . "<br>" . $e->getMessage() . "<br> :: Add Promotion";
            $result = null;
        }
        return $result;
    }

    public function deletePromotionByPromotionId($id) {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM Promotions WHERE id=".$id;
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

    public function deletePromotionByShopId($shopId) {
        $query = '';
        $result = '';
        try {
            $query = "DELETE FROM Promotions WHERE shop_id=".$shopId;
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

    public function getAllPromotions() {
        $query = '';
        $promotionList = array();
        try {
            $query ="SELECT * FROM Promotions";
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
        } catch(PDOException $e) {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Get All Promotion";
        }
        return $promotionList;
    }

    public function getPromotionById($id){
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM Promotions WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
        } catch(PDOException $e) {
            echo $query . "<br>" . $e->getMessage() . "<br> :: Get Promotion By Id";
            $result = null;
        }
        return $result;
    }

    public function editPromotion(Promotion $promotion){
        $query = '';
        $result = '';
        try {
            $query = "UPDATE Promotions SET name = ".Config::$connection->quote($promotion->getName()).
                ", description=".Config::$connection->quote($promotion->getDescription()).", start_date='".$promotion->getStartDate().
                "', end_date='".$promotion->getEndDate()."' WHERE id = ".$promotion->getPromotionId();
            $row = Config::$connection->exec($query);
            $result = $row;
        } catch(PDOException $e) {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Edit Promotion";
            $result = null;
        }
        return $result;
    }

    public function getPromotionByShopId($id)
    {
        $query = '';
        $result = '';
        $promotionList = array();
        try {
            $query ="SELECT * FROM Promotions WHERE shop_id=".$id;
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
            }
            $result = $promotionList;
        } catch(PDOException $e) {
            echo $query . "<br>" . $e->getMessage(). "<br> :: Get Promotion By Shop Id";
            $result = null;
        }
        return $result;
    }
}
