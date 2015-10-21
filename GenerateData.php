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
        if(self::isTheFirstRun()) {
            $query = '';
            try {
                $connection = new PDO(Config::DATABASE_DNS, Config::DATABASE_USERNAME, Config::DATABASE_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "INSERT INTO `Accounts` (`email`, `password`, `role`, `join_date`, `status`) VALUES ('" . Config::ADMIN_USERNAME . "', '" . Config::ADMIN_PASSWORD . "', 'admin', '" . date('Y-m-d') . "', '1')";
                $connection->query($query);
                $startingAdminEmail = ["admin1@gmail.com", "admin2@gmail.com", "admin3@gmail.com", "iamadmin@gmail.com"];
                $startingAdminPassword = ["1234", "1234", "1234", "1234"];
                for ($i = 0; $i < 4; $i++) {
                    $query = "INSERT INTO `Accounts` (`email`, `password`, `role`, `join_date`, `status`) VALUES ('" . $startingAdminEmail[$i] . "', '" . md5($startingAdminPassword[$i]) . "', 'admin', '" . date('Y-m-d') . "', '1')";
                    $connection->query($query);
                }
            }
            catch(PDOException $e)
            {
                echo $query . "<br>" . $e->getMessage();
            }
            $connection = null;
        }
    }

    static function isTheFirstRun(){
        $query = '';
        try {
            $connection = new PDO(Config::DATABASE_DNS, Config::DATABASE_USERNAME, Config::DATABASE_PASSWORD);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM Accounts WHERE id = 1";
            $row = $connection->query($query)->fetch();
            if($row == null) {
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }
        $connection = null;
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