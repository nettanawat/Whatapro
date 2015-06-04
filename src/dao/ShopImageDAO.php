<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 8:02 PM
 */

interface ShopImageDAO {
    public function addImage(ShopImage $shopImage);
    public function deleteImageByShopId($id);
    public function getImageByAccountId($accountId);
    public function getImageById($id);
    public function deleteImageById($id);
} 