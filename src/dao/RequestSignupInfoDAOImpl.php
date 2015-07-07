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

    private $database = '';
    private $table = 'RequestingSignup';

    function __construct()
    {
        $this->database = new medoo();
    }

    //put your code herepublic function addNewRequest(){
    public function deleteRequest($id) {

    }

    public function getAllRequest() {
        $requestList = array();
        foreach ($this->database->select($this->table,'*',["ORDER" => "request_date DESC"]) as $row) {
            $requestList[] = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'],$row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'],$row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
        }
        return $requestList;
    }

    public function getRequesSignupById($id){
        $row = $this->database->get($this->table,'*', ['id' => $id]);
        return new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'],$row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longtitude'], $row['open_time'], $row['description'],$row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
    }

    public function getRequestByStatus($status) {

    }

    public function updateRequest($id,$status) {
        if ($status == true){
            $this->database->update($this->table,['status'=>1],['id'=>$id]);
        } elseif ($status == false) {
            $this->database->update($this->table,['status'=>0],['id'=>$id]);
        } else {

        }
    }

    public function addNewRequest(RequestSignupInfo $requestingSingup) {

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $requestingSingup->setRequestDate($now->format('Y-m-d H:i:s'));
        $data = [
            'email' => $requestingSingup->getEmail(),
            'password' => md5($requestingSingup->getPassword()),
            'name' => $requestingSingup->getName(),
            'address' => $requestingSingup->getAddress(),
            'phone_number' => $requestingSingup->getPhoneNumber(),
            'sub_district' => $requestingSingup->getSubDistrict(),
            'latitude' => $requestingSingup->getLatitude(),
            'longtitude' => $requestingSingup->getLongitude(),
            'open_time' => $requestingSingup->getOpenTime(),
            'description' => $requestingSingup->getDescription(),
            'request_date' => $requestingSingup->getRequestDate(),
            'approve_date' => $requestingSingup->getApproveDate(),
            'manage_by' => $requestingSingup->getManageBy(),
            'status' => $requestingSingup->getStatus(),
        ];
        $query ="INSERT INTO `RequestingSignup` (`email`, `password`, `name`, `address`, `phone_number`, `sub_district`, `latitude`, `longtitude`, `open_time`, `description`, `request_date` , `status`)".
            " VALUES ('".$requestingSingup->getEmail()."' , '".md5($requestingSingup->getPassword())."' , '".$requestingSingup->getName()."' , '".$requestingSingup->getAddress()."' , '".$requestingSingup->getPhoneNumber()."' , '".$requestingSingup->getSubDistrict()."' , '".$requestingSingup->getLatitude()."' , '".$requestingSingup->getLongitude()."' , '".$requestingSingup->getOpenTime()."' , '".$requestingSingup->getDescription()."' , '".$requestingSingup->getRequestDate()."' , '".$requestingSingup->getStatus()."')";
        $this->database->exec($query);
    }

    public function approveRequest($id)
    {
        // TODO: Implement approveRequest() method.
    }
}

