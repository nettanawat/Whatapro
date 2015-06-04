<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 4:42 PM
 */

class CheckInCodeDAOImpl implements CheckInCodeDAO {

    public function getAllCode()
    {
        // TODO: Implement getAllCode() method.
    }

    public function disableCode()
    {
        // TODO: Implement disableCode() method.
    }

    public function getCodeByShopId()
    {
        // TODO: Implement getCodeByShopId() method.
    }

    public function getCodeByFacebookId()
    {
        // TODO: Implement getCodeByFacebookId() method.
    }

    public function randomCode() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}