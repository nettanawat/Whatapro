<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/12/15 AD
 * Time: 3:25 PM
 */

class PointDAOImpl implements PointDAO {

    public function addReceivePoint(PointInfo $pointInfo)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id,total_point FROM RedeemPoint ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = '';
            $totalPoint = 0;
            if($lastId == false) {
                $id = 1;
                $pointInfo->setTotalPoint($pointInfo->getReceivePoint());
            } else {
                $id = $lastId['id']+1;
                $totalPoint = $pointInfo->getReceivePoint()+$lastId['total_point'];
                $pointInfo->setTotalPoint($totalPoint);
            }

            $query = "INSERT INTO RedeemPoint (id, recieve_point, spend_point, total_point, date, MobileUsers_id1) VALUES (".$id.",
             ".Config::$connection->quote($pointInfo->getReceivePoint()).", ".Config::$connection->quote($pointInfo->getSpendPoint()).", ".Config::$connection->quote($pointInfo->getTotalPoint()).", ".Config::$connection->quote($pointInfo->getDate()).", null)";
//            var_dump($query);die;
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

    public function addSpendPoint(PointInfo $pointInfo)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id,total_point FROM RedeemPoint ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = '';
            $totalPoint = 0;
            if($lastId == false) {
                $id = 1;
                $pointInfo->setTotalPoint($pointInfo->getReceivePoint());
            } else {
                $id = $lastId['id']+1;
                $totalPoint = $lastId['total_point']- $pointInfo->getSpendPoint();
                $pointInfo->setTotalPoint($totalPoint);
            }

            $query = "INSERT INTO RedeemPoint (id, recieve_point, spend_point, total_point, date, MobileUsers_id1) VALUES (".$id.",
             ".Config::$connection->quote($pointInfo->getReceivePoint()).", ".Config::$connection->quote($pointInfo->getSpendPoint()).", ".Config::$connection->quote($pointInfo->getTotalPoint()).", ".Config::$connection->quote($pointInfo->getDate()).", null)";
//            var_dump($query);die;
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

    public function getLastPointById($id)
    {
        // TODO: Implement getLastPointById() method.
    }
}