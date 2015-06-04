<?php

include dirname(__FILE__) . '/Config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MockedUpDatas
 *
 * @author NetSmith
 */
class MockedUpDatas {

    //put your code here
    public function prepareUsersdata() {
        $userArray = array();
//        $userArray[] = $accountInfo->_construct(1, "Warp up cafe", "warmup@gmail.com", "1111", 12.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
//        $userArray[] = $accountInfo->_construct(2, "Monkey club", "Monkeyclub@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
//        $userArray[] = $accountInfo->_construct(3, "Mad club", "Mad@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
//        $userArray[] = $accountInfo->_construct(4, "Gay club", "gayblub@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
        $account1 = new AccountInfo(1, "Warm up cafe", "warmup@gmail.com", "1111", 12.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
        $account2 = new AccountInfo(2, "Monkey club", "Monkeyclub@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
        $account3 = new AccountInfo(3, "Mad club", "Mad@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
        $account4 = new AccountInfo(4, "Gay club", "gayblub@gmail.com", "1212", 22.312312312, 12.343242343, "Suthep", "Maung", "Chiang Mai");
        $userArray[] = $account1;
        $userArray[] = $account2;
        $userArray[] = $account3;
        $userArray[] = $account4;
        return $userArray;
    }
    
    public function prepareDistrictData(){
        $districtArray = array();
    }

}

?>
