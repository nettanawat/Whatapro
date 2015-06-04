<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/31/15 AD
 * Time: 11:54 PM
 */

class PromotionImage {
    private $id;
    private $promotionId;
    private $imagePath;
    private $addDate;

    function __construct($id, $promotionId, $imagePath, $addDate)
    {
        $this->addDate = $addDate;
        $this->id = $id;
        $this->imagePath = $imagePath;
        $this->promotionId = $promotionId;
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
     * @param mixed $promotionId
     */
    public function setPromotionId($promotionId)
    {
        $this->promotionId = $promotionId;
    }

    /**
     * @return mixed
     */
    public function getPromotionId()
    {
        return $this->promotionId;
    }



} 