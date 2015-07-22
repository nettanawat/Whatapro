<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PromotionDAO
 *
 * @author NetSmith
 */
interface PromotionDAO {
        
    public function getAllPromotions();
    public function getPromotionByName($name);
    public function addNewPromotion(Promotion $promotion);
    public function getPromotionById($id);
    public function editPromotion(Promotion $promotion);
    public function deletePromotionByPromotionId($id);
    public function deletePromotionByShopId($id);
    public function getPromotionByShopId($id);
}
