<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 7:58 PM
 */

class ShopImage {
    private $id;
    private $shopId;
    private $imagePath;
    private $addDate;

    function __construct($id, $shopId, $imagePath, $addDate)
    {
        $this->addDate = $addDate;
        $this->id = $id;
        $this->imagePath = $imagePath;
        $this->shopId = $shopId;
    }

    /**
     * @param mixed $addDate
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;
    }

    /**
     * @return mixed
     */
    public function getAddDate()
    {
        return $this->addDate;
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
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shopId;
    }

}