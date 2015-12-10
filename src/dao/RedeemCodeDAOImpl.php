<?php

/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/19/15 AD
 * Time: 1:41 PM
 */
class RedeemCodeDAOImpl implements RedeemCodeDAO
{

    public function getAllRedeemCode()
    {
        $query = '';
        $result = array();
        try {
            $query = "SELECT * FROM Codes";
            foreach (Config::$connection->query($query)->fetchAll() as $row) {
                $result[] = new RedeemCode($row['id'], $row['facebook_id'], $row['code'], $row['generate_date'], $row['point_amount'], $row['status']);
            }
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function addRedeemCode(RedeemCode $redeemCode)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId = "SELECT id FROM Codes ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = 0;
            if ($redeemCode->getId() != null) {
                $id = $redeemCode->getId();
            } else {
                $id = $lastId['id'] + 1;
            }
            $query = "INSERT INTO Codes (id, point_amount, code, generate_date, status, facebook_id) VALUES ("
                . $id . ",
                     " . Config::$connection->quote($redeemCode->getPointAmount()) . ",
                      " . Config::$connection->quote($redeemCode->getCode()) . ",
                       " . Config::$connection->quote($redeemCode->getGenerateDate()) . ",
                       " . Config::$connection->quote($redeemCode->getStatus()) . ",
                       " . Config::$connection->quote($redeemCode->getOwner()) . ")";
            $row = Config::$connection->query($query);
            $result = Config::$connection->lastInsertId();
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        $connection = null;
        return $result;
    }

    public function updateRedeemCodeStatus($code)
    {
        $query = '';
        $result = '';
        try {
            $query = "UPDATE Codes SET status=1 WHERE code='" . $code . "'";
            $row = Config::$connection->exec($query);
            $result = $row;
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getRedeemCodeByCode($redeemCode)
    {
        $query = '';
        $result = '';
        try {
            $query = "SELECT * FROM Codes WHERE code ='" . $redeemCode . "'";
            $row = Config::$connection->query($query)->fetch();
            if ($row == false) {
                $result = null;
            } else {
                $result = new RedeemCode($row['id'], $row['facebook_id'], $row['code'], $row['generate_date'], $row['point_amount'], $row['status']);
            }
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }
}