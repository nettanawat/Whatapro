<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/26/15 AD
 * Time: 8:05 PM
 */

class ShopImageDAOImpl implements ShopImageDAO {
    private $database = '';
    private $table = 'ShopImage';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function addImage(ShopImage $shopImage)
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $shopImage->setAddDate($now->format('Y-m-d H:i:s'));
        $data = [
            "shop_id" => $shopImage->getShopId(),
            "image_path" => $shopImage->getImagePath(),
            "added_date" => $shopImage->getAddDate()
        ];
        return $this->database->insert($this->table,$data);
    }

    public function deleteImageByShopId($shopId)
    {
        return $this->database->delete($this->table, ["AND" => ["shop_id" => $shopId]]);
    }

    public function getImageByAccountId($accountId){
        $shopImageList = array();
        if(false == $this->database->select($this->table,'*',['AND'=>['shop_id'=>$accountId]])) {
            return null;
        }else{
            foreach ($this->database->select($this->table,'*',['AND'=>['shop_id'=>$accountId]]) as $row){
                $shopImageList[] = new ShopImage($row['id'], $row['shop_id'], $row['image_path'], $row['added_date']);
            }
            return $shopImageList;
        }
    }

    public function deleteImageById($id)
    {
        return $this->database->delete($this->table, ["AND" => ["id" => $id]]);
    }

    public function getImageById($id)
    {
        $row = $this->database->get($this->table,'*',['AND'=>['id'=>$id]]);
        return new ShopImage($row['id'], $row['shop_id'], $row['image_path'], $row['added_date']);
    }
}