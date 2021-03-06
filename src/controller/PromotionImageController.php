<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/1/15 AD
 * Time: 12:16 AM
 */

class PromotionImageController {
    public function addImage(PromotionImage $promotionImage){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $promotionImage->setAddDate($now->format('Y-m-d H:i:s'));
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->addImage($promotionImage);
    }

    public function getPromotionImageByPromotionId($promotionId){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->getImageByPromotionId($promotionId);
    }

    public function getImageById($id){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->getImageById($id);
    }

    public function deleteImageByPromotionId($promotionId){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->deleteImageByPromotionId($promotionId);
    }

    public function deleteImageById($id){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->deleteImageById($id);
    }
} 