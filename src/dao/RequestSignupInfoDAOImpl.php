<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequestSignupInfoDAOImpl
 *
 * @author NetSmith
 */
class RequestSignupInfoDAOImpl implements RequestSignupInfoDAO {

    public function getAllRequest() {
        $query = '';
        $requestList = array();
        try {
            $query ="SELECT * FROM RequestingSignup";
            foreach(Config::$connection->query($query)->fetchAll() as $row){
                $requestList[] = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'],$row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'],$row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        return $requestList;
    }

    public function getRequestSignupById($id){
        $query = '';
        $result = '';
        try {
            $query ="SELECT * FROM RequestingSignup WHERE id ='" . $id . "'";
            $row = Config::$connection->query($query)->fetch();
            if($row == false) {
                $result = null;
            } else {
                $result = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'],$row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'],$row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function getRequestByStatus($status) {

    }

    public function updateRequestStatus($id,$status, $accountId) {
        $query = '';
        $result = '';
        try {
            $newStatus = '';
            if($status == true) {
                $newStatus = 1;
            } else {
                $newStatus = 0;
            }
            $query = "UPDATE RequestingSignup SET approve_date='".date('Y-m-d H:i:s')."', manage_by =".$accountId.", status=".$newStatus." WHERE id=".$id;
//            var_dump($query);die;
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

    public function addNewRequest(RequestSignupInfo $requestingSingup) {
        $query = '';
        $result = '';
        try {
            $queryGetId ="SELECT id FROM RequestingSignup ORDER BY id DESC LIMIT 1";
            $lastId = Config::$connection->query($queryGetId)->fetch();
            $id = '';
            if($lastId == false) {
                $id = 1;
            } else {
                $id = $lastId['id']+1;
            }
            $query ="INSERT INTO RequestingSignup (id, email, password, name, address, phone_number, sub_district, latitude, longtitude, open_time, description, request_date, status)".
                " VALUES (".$id." , ".Config::$connection->quote($requestingSingup->getEmail())." , '".$requestingSingup->getPassword()."' , ".Config::$connection->quote($requestingSingup->getName()).
                " , ".Config::$connection->quote($requestingSingup->getAddress())." , '".$requestingSingup->getPhoneNumber()."' , '".$requestingSingup->getSubDistrict()."' , '"
                .$requestingSingup->getLatitude()."' , '".$requestingSingup->getLongitude()."' , '".$requestingSingup->getOpenTime()."' , ".Config::$connection->quote($requestingSingup->getDescription())." , '"
                .$requestingSingup->getRequestDate()."' , '".$requestingSingup->getStatus()."')";
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

}

