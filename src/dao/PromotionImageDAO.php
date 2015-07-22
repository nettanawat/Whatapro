<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/31/15 AD
 * Time: 11:53 PM
 */

interface PromotionImageDAO {
    public function addImage(PromotionImage $promotionImage);
    public function getImageByPromotionId($promotionImage);
    public function deleteImageByPromotionId($promotionId);
    public function deleteImageById($id);
} 