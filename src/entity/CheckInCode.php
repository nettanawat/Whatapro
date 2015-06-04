<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 4:36 PM
 */

class CheckInCode {
    private $id;
    private $code;
    private $shop_id;
    private $isAlreadyUsed;
    private $facebookId;

    function __construct($code, $facebookId, $id, $isAlreadyUsed, $shop_id)
    {
        $this->code = $code;
        $this->facebookId = $facebookId;
        $this->id = $id;
        $this->isAlreadyUsed = $isAlreadyUsed;
        $this->shop_id = $shop_id;
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
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
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
     * @param mixed $isAlreadyUsed
     */
    public function setIsAlreadyUsed($isAlreadyUsed)
    {
        $this->isAlreadyUsed = $isAlreadyUsed;
    }

    /**
     * @return mixed
     */
    public function getIsAlreadyUsed()
    {
        return $this->isAlreadyUsed;
    }

    /**
     * @param mixed $shop_id
     */
    public function setShopId($shop_id)
    {
        $this->shop_id = $shop_id;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shop_id;
    }


} 