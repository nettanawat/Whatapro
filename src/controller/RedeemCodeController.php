<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 6/19/15 AD
 * Time: 1:42 PM
 */

class RedeemCodeController {

    static $redeemCodeDaoImpl;

    static function loadClass(){
        self::$redeemCodeDaoImpl = new RedeemCodeDAOImpl();
    }

    static function generateRedeemCode($mobileUserId = '1365239032', $pointAmount = 50){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
        $randomCode = self::getToken();
        while(null != self::$redeemCodeDaoImpl->getRedeemCodeByCode($randomCode)) {
            $randomCode = self::getToken();
        }

        $redeemCode = new RedeemCode('',$mobileUserId, $randomCode,'bar path',$now->format('Y-m-d H:i:s'), $pointAmount, 1);
        self::$redeemCodeDaoImpl->addRedeemCode($redeemCode);
        return $redeemCode;
    }

    private function cryptToRandomSecure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    private function getToken($length = 10){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[self::cryptToRandomSecure(0,strlen($codeAlphabet))];
        }
        return $token;
    }


    static function getAllRedeemCode(){
        return self::$redeemCodeDaoImpl->getAllRedeemCode();
    }
} 