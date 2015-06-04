<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShopInformation
 *
 * @author NetSmith
 */
class ShopInformation {
    private $accountId;
    private $name;
    private $address;
    private $phoneNumber;
    private $subDistrict;
    private $latitude;
    private $longitude;
    private $openTime;
    private $description;
    private $category;
    
    function __construct($accountId, $name, $address, $phoneNumber, $subDistrict, $latitude, $longitude, $openTime, $description, $category) {
        $this->accountId = $accountId;
        $this->name = $name;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->subDistrict = $subDistrict;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->openTime = $openTime;
        $this->description = $description;
        $this->category = $category;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $openTime
     */
    public function setOpenTime($openTime)
    {
        $this->openTime = $openTime;
    }

    /**
     * @return mixed
     */
    public function getOpenTime()
    {
        return $this->openTime;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $subDistrict
     */
    public function setSubDistrict($subDistrict)
    {
        $this->subDistrict = $subDistrict;
    }

    /**
     * @return mixed
     */
    public function getSubDistrict()
    {
        return $this->subDistrict;
    }




}
