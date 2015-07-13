<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/10/15 AD
 * Time: 2:30 PM
 */
class GenerateData
{


    static function createAdmin()
    {
        $database = new medoo();
        if ($database->get('Accounts', '*', ['id' => 1])) {

        } else {
            $query = "INSERT INTO `Accounts` (`email`, `password`, `role`, `join_date`, `status`) VALUES ('" . Config::ADMIN_USERNAME . "', '" . Config::ADMIN_PASSWORD . "', 'admin', '" . date('Y-m-d') . "', '1')";
            $database->exec($query);
            $startingAdminEmail = ["admin1@gmail.com", "admin2@gmail.com", "admin3@gmail.com", "iamadmin@gmail.com", "iamfuckingadmin@gmail.com",];
            $startingAdminPassword = ["1234", "1234", "1234", "1234", "1234"];
            $startingId = 10;
            for ($i = 0; $i < 5; $i++) {
                if ($i == 0) {
                    $query = "INSERT INTO `Accounts` (`id`, `email`, `password`, `role`, `join_date`, `status`) VALUES ('" . $startingId . "', '" . $startingAdminEmail[$i] . "', '" . md5($startingAdminPassword[$i]) . "', 'admin', '" . date('Y-m-d') . "', '1')";
                } else {
                    $query = "INSERT INTO `Accounts` (`email`, `password`, `role`, `join_date`, `status`) VALUES ('" . $startingAdminEmail[$i] . "', '" . md5($startingAdminPassword[$i]) . "', 'admin', '" . date('Y-m-d') . "', '1')";
                }
                $database->exec($query);
            }
        }
    }

    static function generateAccount($numberOfAccount) {
        $database = new medoo();
        if ($database->get('Accounts', 'id', ['id' => 100])) {

        } else {
            for($i = 0; $i < $numberOfAccount; $i++){
                if($i == 0) {
                    $addAccountQuery = "INSERT INTO `Accounts` (`id`, `email`, `password`, `role`, `join_date`, `status`) VALUES ('100', 'account".$i."@gmail.com', '" . md5('1234') . "', 'user', '" . date('Y-m-d H:m:s') . "', '1')";
                    $database->exec($addAccountQuery);
                    $addShopInformationQuery = "INSERT INTO `ShopInformations` (`accounts_id`, `name`, `address`, `phone_number`, `open_time`)
                        VALUES ('100', 'Account".$i."', '4".$i." Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200', '053 400 666', 'Everyday from 8.00AM - 10.00PM')";
                    $database->exec($addShopInformationQuery);
                } else {
                $addAccountQuery = "INSERT INTO `Accounts` (`id`, `email`, `password`, `role`, `join_date`, `status`) VALUES ('', 'account".$i."@gmail.com', '" . md5('1234') . "', 'user', '" . date('Y-m-d H:m:s') . "', '1')";
                $database->exec($addAccountQuery);
                $accountId = $database->pdo->lastInsertId();
                $addShopInformationQuery = "INSERT INTO `ShopInformations` (`accounts_id`, `name`, `address`, `phone_number`, `open_time`)
                 VALUES ('".$accountId."', 'Account".$i."', '4".$i." Nimmarnhemin Rd., T.Suthep, A.Muang,, Chiang Mai, 50200', '053 400 666', 'Everyday from 8.00AM - 10.00PM')";
                $database->exec($addShopInformationQuery);
                }
            }
        }
    }

}