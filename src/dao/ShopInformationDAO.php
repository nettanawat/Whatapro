<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShopInformationDAO
 *
 * @author NetSmith
 */
interface ShopInformationDAO {
    public function getAllShopInformation();
    public function deleteShopInformation($id);
    public function editShopInformation(ShopInformation $shopInformation);
    public function addNewShopInformation(ShopInformation $shopInformation);
    public function getShopInformationById($id);
}
