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

    //put your code herepublic function addNewRequest(){
    public function deleteRequest($id) {
        $sqlConnector = new SQLConnector();
        $sqlConnector->disableARow("RequestingSignup", $id);
    }

    public function getAllRequest() {
        return SQLConnector::getDataFromTable("RequestingSignup");
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
        $sqlConnector = new SQLConnector();
        $columnNames = array();
        $columnNames[] = "email";
        $columnNames[] = "password";
        $columnNames[] = "name";
        $columnNames[] = "phone_number";
        $columnNames[] = "sub_district";
        $columnNames[] = "latitude";
        $columnNames[] = "longtitude";
        $columnNames[] = "open_time";
        $columnNames[] = "description";
        $columnNames[] = "image";
        $columnNames[] = "request_date";
        $columnNames[] = "approve_date";
        $columnNames[] = "manage_by";
        $columnNames[] = "status";
        
        $columnValues = array();
        $columnValues[] = $requestingSingup->getEmail();
        $columnValues[] = $requestingSingup->getPassword();
        $columnValues[] = $requestingSingup->getName();
        $columnValues[] = $requestingSingup->getPhoneNumber();
        $columnValues[] = $requestingSingup->getSubDistrict();
        $columnValues[] = $requestingSingup->getLatitude();
        $columnValues[] = $requestingSingup->getLongitude();
        $columnValues[] = $requestingSingup->getOpenTime();
        $columnValues[] = $requestingSingup->getDescription();
        $columnValues[] = $requestingSingup->getImage();
        $columnValues[] = $requestingSingup->getRequestDate();
        $columnValues[] = $requestingSingup->getApproveDate();
        $columnValues[] = $requestingSingup->getManageBy();
        $columnValues[] = $requestingSingup->getStatus();
        SQLConnector::insertDataIntoDatabase("RequestingSignup", $columnNames, $columnValues);
    }

}

?>
