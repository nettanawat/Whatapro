<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/19/15 AD
 * Time: 1:16 PM
 */

class RedeemCode {

    private $id;
    private $owner;
    private $code;
    private $barcodePath;
    private $generate_date;
    private $pointAmount;
    private $status;

    function __construct($id, $owner, $code, $barcodePath, $generate_date, $pointAmount, $status)
    {
        $this->barcodePath = $barcodePath;
        $this->code = $code;
        $this->generate_date = $generate_date;
        $this->id = $id;
        $this->owner = $owner;
        $this->pointAmount = $pointAmount;
        $this->status = $status;
    }

    /**
     * @param mixed $barcodePath
     */
    public function setBarcodePath($barcodePath)
    {
        $this->barcodePath = $barcodePath;
    }

    /**
     * @return mixed
     */
    public function getBarcodePath()
    {
        return $this->barcodePath;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $generate_date
     */
    public function setGenerateDate($generate_date)
    {
        $this->generate_date = $generate_date;
    }

    /**
     * @return mixed
     */
    public function getGenerateDate()
    {
        return $this->generate_date;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $pointAmount
     */
    public function setPointAmount($pointAmount)
    {
        $this->pointAmount = $pointAmount;
    }

    /**
     * @return mixed
     */
    public function getPointAmount()
    {
        return $this->pointAmount;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
}