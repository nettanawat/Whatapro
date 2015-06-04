<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShopInformationDAOImpl
 *
 * @author NetSmith
 */
class ShopInformationDAOImpl implements ShopInformationDAO {
    private $database = '';
    private $table = 'ShopInformations';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function addNewShopInformation(ShopInformation $shopInformation) {
        $data = [
            'accounts_id' => $shopInformation->getAccountId(),
            'name' => $shopInformation->getName(),
            'address' => $shopInformation->getAddress(),
            'phone_number' => $shopInformation->getPhoneNumber(),
            'sub_district' => $shopInformation->getSubDistrict(),
            'latitude' => $shopInformation->getLatitude(),
            'longitude' => $shopInformation->getLongitude(),
            'open_time' => $shopInformation->getOpenTime(),
            'description' => $shopInformation->getDescription(),
            'category' => $shopInformation->getCategory()
        ];
        return $this->database->insert($this->table, $data);
    }

    public function deleteShopInformation($id) {
        return $this->database->delete($this->table, ["AND" => ["accounts_id" => $id]]);
    }

    public function editShopInformation(ShopInformation $shopInformation) {
        $query = "UPDATE ".$this->table." SET name = '".$shopInformation->getName()."', address = '".$shopInformation->getAddress()."',
          phone_number = '".$shopInformation->getPhoneNumber()."', latitude = '".$shopInformation->getLatitude()."', longitude = '".$shopInformation->getLongitude()."',
          open_time = '".$shopInformation->getOpenTime()."', description = '".$shopInformation->getDescription()."', category = '".$shopInformation->getCategory()."'
          WHERE accounts_id = '".$shopInformation->getAccountId()."'";
        $this->database->exec($query);
    }

    public function getAllShopInformation() {
        $shopInformationList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $shopInformationList[] = new ShopInformation($row['accounts_id'], $row['name'], $row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['category']);
        }
        return $shopInformationList;
    }

    public function getShopInformationById($id){
        $row = $this->database->get($this->table,'*',['AND'=>['accounts_id'=>$id]]);
        return new ShopInformation($row['accounts_id'], $row['name'], $row['address'], $row['phone_number'], $row['sub_district'], $row['latitude'], $row['longitude'], $row['open_time'], $row['description'], $row['category']);
    }
}
