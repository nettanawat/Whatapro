<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 9/4/14 AD
 * Time: 4:39 PM
 */

interface CheckInCodeDAO {
    public function getAllCode();
    public function disableCode();
    public function getCodeByShopId();
    public function getCodeByFacebookId();
} 