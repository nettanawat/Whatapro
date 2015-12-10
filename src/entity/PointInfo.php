<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/12/15 AD
 * Time: 3:21 PM
 */

class PointInfo {
    private $id;
    private $receivePoint;
    private $spendPoint;
    private $totalPoint;
    private $date;
    private $mobileUserId;

    function __construct($date, $id, $mobileUserId, $receivePoint, $spendPoint, $totalPoint)
    {
        $this->date = $date;
        $this->id = $id;
        $this->mobileUserId = $mobileUserId;
        $this->receivePoint = $receivePoint;
        $this->spendPoint = $spendPoint;
        $this->totalPoint = $totalPoint;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
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
     * @param mixed $mobileUserId
     */
    public function setMobileUserId($mobileUserId)
    {
        $this->mobileUserId = $mobileUserId;
    }

    /**
     * @return mixed
     */
    public function getMobileUserId()
    {
        return $this->mobileUserId;
    }

    /**
     * @param mixed $receivePoint
     */
    public function setReceivePoint($receivePoint)
    {
        $this->receivePoint = $receivePoint;
    }

    /**
     * @return mixed
     */
    public function getReceivePoint()
    {
        return $this->receivePoint;
    }

    /**
     * @param mixed $spendPoint
     */
    public function setSpendPoint($spendPoint)
    {
        $this->spendPoint = $spendPoint;
    }

    /**
     * @return mixed
     */
    public function getSpendPoint()
    {
        return $this->spendPoint;
    }

    /**
     * @param mixed $totalPoint
     */
    public function setTotalPoint($totalPoint)
    {
        $this->totalPoint = $totalPoint;
    }

    /**
     * @return mixed
     */
    public function getTotalPoint()
    {
        return $this->totalPoint;
    }




} 