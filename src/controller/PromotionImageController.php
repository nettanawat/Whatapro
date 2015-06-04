<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/1/15 AD
 * Time: 12:16 AM
 */

class PromotionImageController {
    public function addImage(PromotionImage $promotionImage){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->addImage($promotionImage);
    }

    public function getPromotionImageByPromotionId($promotionId){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->getImageByPromotionId($promotionId);
    }

    public function deleteImageByPromotionId($promotionId){
        $promotionImageDAOImpl = new PromotionImageDAOImpl();
        return $promotionImageDAOImpl->deleteImageByPromotionId($promotionId);
    }
} 