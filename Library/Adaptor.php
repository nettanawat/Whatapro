<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adaptor
 *
 * @author NetSmith
 */
class Adaptor
{

    //put your code here
    static $status;
    static $accountType;
    static $district;

    static function getStatus()
    {
        return self::$status;
    }

    static function setStatus($status)
    {
        if ($status < 3 && $status >= 0) {
            switch ($status) {
                case 0:
                    self::$status = "inactive";
                    break;
                case 1:
                    self::$status = "active";
                    break;
                case 2:
                    self::$status = "waiting";
                    break;
            }
        } else {
            self::$status = null;
        }
    }

    static function getAccountType()
    {
        return self::$accountType;
    }

    static function setAccountType($accountType)
    {
        if ($accountType < 2 && $accountType >= 0) {
            switch ($accountType) {
                case 0:
                    self::$accountType = "admin";
                    break;
                case 1:
                    self::$accountType = "user";
                    break;
            }
        } else {
            self::$accountType = null;
        }
    }

    static function setSubDistrict($district)
    {
        if ($district < 11 && $district > 0) {
            switch ($district) {
                case 1:
                    self::$district = "Suthep";
                    break;
                case 2:
                    self::$district = "Nai Maung";
                    break;
                case 3:
                    self::$district = "Si Phum";
                    break;
                case 4:
                    self::$district = "Phra Sing";
                    break;
                case 5:
                    self::$district = "Chang Phueak";
                    break;
                case 6:
                    self::$district = "Mae Hia";
                    break;
                case 7:
                    self::$district = "Pa Daet";
                    break;
                case 8:
                    self::$district = "Pa Tan";
                    break;
                case 9:
                    self::$district = "Chang Moi";
                    break;
                case 10:
                    self::$district = "Chang Khlan";
                    break;
            }
        } else {
            self::$district = null;
        }
    }

    static function getSubDistrict()
    {
        return self::$district;
    }
}
?>
