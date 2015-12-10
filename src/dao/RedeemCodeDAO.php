<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/19/15 AD
 * Time: 1:30 PM
 */

interface RedeemCodeDAO {
    public function getAllRedeemCode();
    public function getRedeemCodeByCode($redeemCode);
    public function addRedeemCode(RedeemCode $redeemCode);
    public function updateRedeemCodeStatus($code);

} 