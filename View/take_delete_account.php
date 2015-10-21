<?php

include dirname(__FILE__) . '/../Config.php';

if (isset($_POST['userId'])) { //delete account
    $id = $_POST['userId'];
    $account = AccountController::getAccountById($id);
    /*
     * if delete account
     * 1. delete promotion image
     * 2. promotion
     * 3. shop image
     * 4. shop info
     * 5. log
     * 6. account
     * */

    $promotionImageController = new PromotionImageController();
    $promotionList = PromotionController::getPromotionByShopId($account->getAccountId());
    foreach ($promotionList as $promotion) {
//                delete promotion image
        $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
        $promotionImageController->deleteImageByPromotionId($promotion->getPromotionId());
        if($promotionImageList != null) {
            foreach ($promotionImageList as $promotionImage) {
                unlink("../".$promotionImage->getImagePath());
            }
            //            delete promotion folder
        }
        $removePromotionImage = rmdir("../user_upload/" . $account->getAccountId() . "/promotions/" . $promotion->getPromotionId());
    }
    $promotionDirectory = "../user_upload/" . $account->getAccountId() . "/promotions";
    if(is_dir($promotionDirectory)){
        rmdir($promotionDirectory);
    }
//        delete promotion
    $deletePromotion = PromotionController::deletePromotionByShopId($account->getAccountId());
    $deleteShopImageDb = '';
    //        delete shop image
    $shopImageController = new ShopImageController();
    $shopImageList = $shopImageController->getImageByAccountId($account->getAccountId());
    if($shopImageList != null){
        foreach ($shopImageList as $imageAccount) {
            unlink("../".$imageAccount->getImagePath());
        }
//        delete shop image **return number of deleted data**
        $deleteShopImageDb = $shopImageController->deleteShopImageByShopId($account->getAccountId());
    }

    $shopImageDirectory = "../user_upload/" . $account->getAccountId() . "/shop_images";
    if(is_dir($shopImageDirectory)){
        rmdir($shopImageDirectory);
    }

    $accountDirectory = "../user_upload/" . $account->getAccountId();
    if(is_dir($accountDirectory)) {
        rmdir($accountDirectory);
    }


//        delete shop info **return number of deleted data**
    $deleteShopInfoDb = ShopInformationController::deleteShopInformation($account->getAccountId());

    $deleteAccountDb = AccountController::deleteAccount($account->getAccountId());
    echo $id;
}