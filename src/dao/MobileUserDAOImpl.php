<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/15/15 AD
 * Time: 12:24 PM
 */

class MobileUserDAOImpl implements MobileUserDAO {

    function addMobileUser(MobileUser $mobileUser)
    {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id FROM MobileUsers ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = 0;
            if($mobileUser->getId() != null){
                $id = $mobileUser->getId();
            } else{
                $id = $lastId['id']+1;
            }
            $queryCheckIsExist = "SELECT id FROM MobileUsers WHERE facebook_id ='".$mobileUser->getFbId()."'";
            $userFromDB = Config::$connection->query($queryCheckIsExist)->fetch();

            if($userFromDB == false){

                $query ="INSERT INTO MobileUsers (id, facebook_id, username, point) VALUES ("
                    .$id.",
                     ".Config::$connection->quote($mobileUser->getFbId()).",
                      ".Config::$connection->quote($mobileUser->getFbUsername()).", 0 )";

                $row = Config::$connection->query($query);
                $result = Config::$connection->lastInsertId();
            } else {

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

    function getMobileUserById($id)
    {
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM MobileUsers WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new MobileUser($row['facebook_id'], $row['username'], $row['id'], $row['point']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    function getAll()
    {
        $query = '';
        $result = array();
        try {
            $query ="SELECT * FROM MobileUsers";
                foreach(Config::$connection->query($query)->fetchAll() as $row) {
                    $result[] = new MobileUser($row['facebook_id'], $row['username'], $row['id'], $row['point']);
                }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    function getMobileUserByFbId($FbId)
    {
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM MobileUsers WHERE facebook_id ='" . $FbId . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new MobileUser($row['facebook_id'], $row['username'], $row['id'], $row['point']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    function addPoint($FbId, $point)
    {
        $query = '';
        $result = '';
        try {
            $getPoint = "SELECT * FROM MobileUsers WHERE facebook_id='".$FbId."'";
            $row1 = Config::$connection->query($getPoint)->fetch();
            $point = $point+$row1['point'];
            $query = "UPDATE MobileUsers SET point=".$point." WHERE facebook_id='".$FbId."'";
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

    function deductPoint($FbId, $point)
    {
        $query = '';
        $result = '';
        try {
            $getPoint = "SELECT * FROM MobileUsers WHERE facebook_id='".$FbId."'";
            $row1 = Config::$connection->query($getPoint)->fetch();
            $point = $row1['point'] - $point;
            $query = "UPDATE MobileUsers SET point=".$point." WHERE facebook_id='".$FbId."'";
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