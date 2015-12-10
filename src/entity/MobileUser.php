<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/15/15 AD
 * Time: 12:17 PM
 */

class MobileUser {
    private $id;
    private $fbId;
    private $fbUsername;
    private $point;

    function __construct($fbId, $fbUsername, $id, $point)
    {
        $this->fbId = $fbId;
        $this->fbUsername = $fbUsername;
        $this->id = $id;
        $this->point = $point;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     */
    public function setPoint($point)
    {
        $this->point = $point;
    }



    /**
     * @param mixed $fbId
     */
    public function setFbId($fbId)
    {
        $this->fbId = $fbId;
    }

    /**
     * @return mixed
     */
    public function getFbId()
    {
        return $this->fbId;
    }

    /**
     * @param mixed $fbUsername
     */
    public function setFbUsername($fbUsername)
    {
        $this->fbUsername = $fbUsername;
    }

    /**
     * @return mixed
     */
    public function getFbUsername()
    {
        return $this->fbUsername;
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



} 