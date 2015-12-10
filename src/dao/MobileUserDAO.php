<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/15/15 AD
 * Time: 12:22 PM
 */

interface MobileUserDAO {
    function addMobileUser(MobileUser $mobileUser);
    function getMobileUserByFbId($FbId);
    function addPoint($FbId, $point);
    function deductPoint($FbId, $point);
}