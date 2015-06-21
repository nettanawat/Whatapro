<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/19/15 AD
 * Time: 1:41 PM
 */

class RedeemCodeDAOImpl implements RedeemCodeDAO {
    private $database = '';
    private $table = 'Codes';

    function __construct()
    {
        $this->database = new medoo();
    }

    public function getAllRedeemCode()
    {
        $accountList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $accountList[] = new RedeemCode($row['id'], '1892312344', $row['code'],$row['barcode_path'],$row['generate_date'],$row['point_amount'],$row['status']);
        }
        return $accountList;
    }

    public function addRedeemCode(RedeemCode $redeemCode)
    {
        $data = [
            'code' => $redeemCode->getCode(),
            'point_amount' => $redeemCode->getPointAmount(),
            'barcode_path' => $redeemCode->getBarcodePath(),
            'generate_date' => $redeemCode->getGenerateDate(),
            'status' => $redeemCode->getStatus()
        ];
        return $this->database->insert($this->table, $data);
    }

    public function updateRedeemCodeStatus()
    {
        // TODO: Implement updateRedeemCodeStatus() method.
    }

    public function getRedeemCodeByCode($redeemCode)
    {
        $row = $this->database->get($this->table,'*',['AND'=>['code'=>$redeemCode]]);
        if(false == $row) {
            return null;
        }
        else {
            return new RedeemCode($row['id'], '1892312344', $row['code'],$row['barcode_path'],$row['generate_date'],$row['point_amount'],$row['status']);
        }
    }
}