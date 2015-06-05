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
        $sqlConnector = new SQLConnector();
        $sqlConnector->disableARow("RequestingSignup", $id);
    }

    public function getAllRequest() {
        $requestList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $requestList[] = new RequestSignupInfo($row['id'], $row['email'], $row['password'], $row['name'],$row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'],$row['request_date'], $row['approve_date'], $row['manage_by'], $row['status']);
        }
        return $requestList;
    }

    public function getRequesSignupById($id){
        foreach($this->getAllRequest() as $request){
            if($id == $request->getId()){
                return $request;
            }
        }
        return null;
    }

    public function getRequestByStatus($status) {
        foreach($this->getAllRequest() as $request){
            if($status == $request->getStatus()){
                return $request;
            }
        }
        return null;
    }

    public function updateRequest($id) {
        $sqlConnector = new SQLConnector();
        $sqlConnector->updateStatusDataToDatabase("RequestingSignup", $id, "");
    }

    public function addNewRequest(RequestSignupInfo $requestingSingup) {

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $requestingSingup->setRequestDate($now->format('Y-m-d H:i:s'));
        $data = [
            'email' => $requestingSingup->getEmail(),
            'password' => md5($requestingSingup->getPassword()),
            'name' => $requestingSingup->getName(),
            'address' => $requestingSingup->getAddress(),
            'phone_number' => $requestingSingup->getPhoneNumber(),
            'sub_district' => $requestingSingup->getSubDistrict(),
            'latitude' => $requestingSingup->getLatitude(),
            'longitude' => $requestingSingup->getLongitude(),
            'open_time' => $requestingSingup->getOpenTime(),
            'description' => $requestingSingup->getDescription(),
            'request_date' => $requestingSingup->getRequestDate(),
            'approve_date' => $requestingSingup->getApproveDate(),
            'manage_by' => $requestingSingup->getManageBy(),
            'status' => $requestingSingup->getStatus(),
        ];
        return $this->database->insert($this->table, $data);
    }

    public function approveRequest($id)
    {
        // TODO: Implement approveRequest() method.
    }
}

