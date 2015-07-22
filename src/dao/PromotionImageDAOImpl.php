<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/31/15 AD
 * Time: 11:54 PM
 */

class PromotionImageDAOImpl implements PromotionImageDAO {

    private $database = '';
    private $table = 'PromotionImage';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function addImage(PromotionImage $promotionImage)
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $promotionImage->setAddDate($now->format('Y-m-d H:i:s'));
        $data = [
            "promotion_id" => $promotionImage->getPromotionId(),
            "image_path" => $promotionImage->getImagePath(),
            "add_date" => $promotionImage->getAddDate(),
        ];
        return $this->database->insert($this->table,$data);
    }

    public function getImageByPromotionId($promotionId)
    {
        $promotionImageList = array();
        if(false == $this->database->select($this->table,'*',['AND'=>['promotion_id'=>$promotionId]])) {
            return null;
        }else{
            foreach ($this->database->select($this->table,'*',['AND'=>['promotion_id'=>$promotionId]]) as $row){
                $promotionImageList[] = new PromotionImage($row['id'], $row['promotion_id'], $row['image_path'], $row['add_date']);
            }
            return $promotionImageList;
        }
    }


    public function getImageById($id){
        $row = $this->database->get($this->table,'*',['AND'=>['id'=>$id]]);
        return new PromotionImage($row['id'], $row['promotion_id'], $row['image_path'], $row['add_date']);
    }

    public function deleteImageByPromotionId($promotionId)
    {
        return $this->database->delete($this->table,['AND'=>['promotion_id'=>$promotionId]]);
    }

    public function deleteImageById($id)
    {
        return $this->database->delete($this->table,['AND'=>['id'=>$id]]);
    }
}