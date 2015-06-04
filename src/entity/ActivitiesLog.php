<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/26/14 AD
 * Time: 1:43 PM
 */

class ActivitiesLog {
    private $id;
    private $accountId;
    private $method;
    private $module;
    private $detail;
    private $date;

    function __construct($id, $accountId, $method, $module, $detail, $date)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->detail = $detail;
        $this->date = $date;
        $this->method = $method;
        $this->module = $module;
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
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
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
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

} 