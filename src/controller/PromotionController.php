<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/21/15 AD
 * Time: 3:09 PM
 */

class PromotionController {

    static $promotionDaoImpl;

    static function loadClass()
    {
        self::$promotionDaoImpl = new PromotionDAOImpl();
    }

    static function addPromotion(Promotion $promotion){
        $promotionId = self::$promotionDaoImpl->addNewPromotion($promotion);
        $old = umask(0);
        $folderPath = "user_upload/".$promotion->getAccountId()."/promotions/".$promotionId."/";
        mkdir("../".$folderPath, 0777,true);

        $target_dir = $folderPath;
        umask($old);
        $target_file = array();
        $realPath = array();
        //check how many files
        $i=0;
        if(isset($_FILES)) {
            foreach ($_FILES["files"]["name"] as $aImage) {
                $realPath[] = $target_dir . basename($aImage);
                $target_file[] = "../".$realPath[$i];
                $i++;
            }
            $i = 0;
            $uploadPath = array();
            foreach ($_FILES["files"]["tmp_name"] as $imageTmp) {
                if (move_uploaded_file($imageTmp, $target_file[$i])) {
                    $uploadPath[] = $realPath[$i];
                }
                else{
                    var_dump(move_uploaded_file($imageTmp, $target_file[$i]));
                }
                $i++;
            }
            //add image
            foreach($uploadPath as $image){
                $promotionImageController = new PromotionImageController();
                $promotionImageController->addImage(new PromotionImage("", $promotionId, $image,""));
            }
        }
        return $promotionId;

    }

    static function deletePromotionByPromotionId($id){
        return self::$promotionDaoImpl->deletePromotionByPromotionId($id);
    }

    static function deletePromotionByShopId($shopId){
        return self::$promotionDaoImpl->deletePromotionByShopId($shopId);
    }

    static function editPromotion(Promotion $promotion){
        return self::$promotionDaoImpl->editPromotion($promotion);
    }

    static function getPromotionById($id){
        return self::$promotionDaoImpl->getPromotionById($id);
    }

    static function getPromotionByName($name){
        return self::$promotionDaoImpl->getPromotionByName($name);
    }

    static function getPromotionByStatus($status){
        return self::$promotionDaoImpl->getPromotionByStatus($status);
    }

    static function getAllPromotion(){
        return self::$promotionDaoImpl->getAllPromotions();
    }

    static function getPromotionByShopId($id){
        return self::$promotionDaoImpl->getPromotionByShopId($id);
    }
} 