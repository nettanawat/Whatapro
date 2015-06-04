<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PromotionDAOImpl
 *
 * @author NetSmith
 */
class PromotionDAOImpl implements PromotionDAO{
    private $database = '';
    private $table = 'Promotions';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function addNewPromotion(Promotion $promotion) {
        $data = [
            'shop_id' => $promotion->getAccountId(),
            'name' => $promotion->getName(),
            'description' => $promotion->getDescription(),
            'shared' => $promotion->getShared(),
            'start_date' => $promotion->getStartDate(),
            'end_date' => $promotion->getEndDate(),
            'status' => $promotion->getStatus(),
        ];
        return $this->database->insert($this->table, $data);
    }

    public function deletePromotionByPromotionId($id) {
        $this->database->delete($this->table, ["AND" => ["id" => $id]]);
    }

    public function deletePromotionByShopId($shopId) {
        $this->database->delete($this->table, ["AND" => ["shop_id" => $shopId]]);
    }

    public function getAllPromotions() {
        $promotionList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        }
        return $promotionList;
    }

    public function getPromotionByName($promotionName) {
        $row = $this->database->get($this->table,'*',['AND'=>['name'=>$promotionName]]);
        return new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
    }

    public function getPromotionById($id){
        $row = $this->database->get($this->table,'*',['AND'=>['id'=>$id]]);
        return new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
    }

    public function editPromotion(Promotion $promotion){
        $data = [
            'shop_id' => $promotion->getAccountId(),
            'name' => $promotion->getName(),
            'description' => $promotion->getDescription(),
            'shared' => $promotion->getShared(),
            'start_date' => $promotion->getStartDate(),
            'end_date' => $promotion->getEndDate(),
            'status' => $promotion->getStatus(),
        ];
        return $this->database->update($this->table, $data);
    }

    public function getPromotionByStatus($status)
    {
        $promotionList = array();
        foreach ($this->database->select($this->table,'*',['AND'=>['status'=>$status]]) as $row) {
            $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        }
        return $promotionList;
    }


    public function getPromotionByShopId($id)
    {
        $promotionList = array();
        foreach ($this->database->select($this->table,'*',['AND'=>['shop_id'=>$id]]) as $row) {
            $promotionList[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
        }
        return $promotionList;
    }
}
