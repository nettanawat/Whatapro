<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequestSignupInfo
 *
 * @author NetSmith
 */
class RequestSignupInfo {
    
    private $id;
    private $email;
    private $password;
    private $name;
    private $phoneNumber;
    private $subDistrict;
    private $latitude;
    private $longitude;
    private $openTime;
    private $description;
    private $image;
    private $requestDate;
    private $approveDate;
    private $manageBy;
    private $status;

    function __construct($id, $email, $password, $name, $phoneNumber, $subDistrict, $latitude, $longitude, $openTime, $description, $image, $requestDate, $approveDate, $manageBy, $status) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->subDistrict = $subDistrict;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->openTime = $openTime;
        $this->description = $description;
        $this->image = $image;
        $this->requestDate = $requestDate;
        $this->approveDate = $approveDate;
        $this->manageBy = $manageBy;
        $this->status = $status;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getSubDistrict() {
        return $this->subDistrict;
    }

    public function setSubDistrict($subDistrict) {
        $this->subDistrict = $subDistrict;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function getOpenTime() {
        return $this->openTime;
    }

    public function setOpenTime($openTime) {
        $this->openTime = $openTime;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getRequestDate() {
        return $this->requestDate;
    }

    public function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    public function getApproveDate() {
        return $this->approveDate;
    }

    public function setApproveDate($approveDate) {
        $this->approveDate = $approveDate;
    }

    public function getManageBy() {
        return $this->manageBy;
    }

    public function setManageBy($manageBy) {
        $this->manageBy = $manageBy;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}

?>
