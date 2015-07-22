<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/2/15 AD
 * Time: 2:05 PM
 */
include dirname(__FILE__) . '/../Config.php';
$database = new medoo();
$query = "SELECT * FROM Accounts INNER JOIN ShopInformations ON Accounts.id = ShopInformations.accounts_id WHERE Accounts.email LIKE '%" . $_GET['key'] . "%' OR ShopInformations.name LIKE '%" . $_GET['key'] . "%' OR Accounts.id LIKE '%" . $_GET['key'] . "%' ORDER BY id DESC";
$accountList = array();
if ($_GET['key'] == "") {
    $accountList = AccountController::getAllAccount();
} else {
    foreach ($database->query($query)->fetchAll() as $row) {
        $accountList[] = new AccountInfo($row['id'], $row['email'], $row['password'], $row['role'], $row['join_date'], $row['status']);
    }
}

foreach ($accountList as $account) {
    $shopInfo = ShopInformationController::getShopInformationById($account->getAccountId());
    $shopName = '-';
    $shopImageList = array();
    $shopImageController = new ShopImageController();

    if ($shopInfo->getName() != null) {
        $shopName = "<a href='profile.php?accountId=" . $shopInfo->getAccountId() . "' >" . $shopInfo->getName() . "</a>";
    }

    $imageList = $shopImageController->getImageByAccountId($account->getAccountId());

    if ($shopImageController->getImageByAccountId($account->getAccountId()) != null) {
        foreach ($imageList as $image) {
            $shopImageList[] = $image->getImagePath();
        }
    }

    Adaptor::setStatus($account->getStatus());
    echo '<tr class="tableData">
                <td>' . $account->getAccountId() . '</td>
                <td>' . $account->getEmail() . '</td>
                <td>' . $account->getRole() . '</td>
                <td>' . $account->getJoinDate() . '</td>
                <td>' . $shopName . '</td>
                <td class="col-md-4">';
    foreach ($shopImageList as $aImage) {
        //change path
        echo '<img class="col-md-3" src="' . Config::PATH . '/whatapro/' . $aImage . '">';
    }
    echo '</td><td>' . Adaptor::getStatus() . '</td>';
    if ('admin' == $account->getRole()) {
        echo '<td>
                            <form name=deleteuser action="" method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button style="color: lightgrey;" type=submit disabled><span class="glyphicon glyphicon-edit"></span></button>
                                <button style="color: lightgrey;" name="delete" type=submit disabled><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                            </td>';
    } else if (0 == $account->getStatus()) {
        echo '<td>
                            <form name=deleteuser action="" method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button style="color: lightgrey;" type=submit disabled><span class="glyphicon glyphicon-edit"></span></button>
                                <button type=submit name="enable" class="btn btn-success btn-xs">Enable</button>
                            </form>
                        </td>';
    } else if (1 == $account->getStatus()) {
        echo '
                        <td>
                            <form name=deleteuser action="" method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button  onclick="show_alert();" name="delete" type=submit><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </td>';
    }
    echo '</tr>';
}
