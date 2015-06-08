<?php
include_once 'session.php';
// only admin has access

if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: error_message.php');
    exit;
}
if ('admin' == $user_type) {
    if (isset($_POST['edit'])) { //edit account
        header("Location: edit_account.php?userId=" . $_POST['userId']);
    } else if (isset($_POST['delete'])) { //delete account

        $account = AccountController::getAccountById($_POST['userId']);
//        log
        $actionDetail = "delete account in account list [" . $account->getEmail() . "]";
        ActivitiesLogController::addLog(new ActivitiesLog('', $logInAccount->getAccountId(), 'delete', 'account', $actionDetail, ''));
        /*
         * if delete account
         * 1. delete promotion image
         * 2. promotion
         * 3. shop image
         * 4. shop info
         * 5. log
         * 6. account
         * */
        $promotionImageController = new PromotionImageController();
        $promotionList = PromotionController::getPromotionByShopId($account->getAccountId());
        foreach ($promotionList as $promotion) {
//                delete promotion image
            $promotionImageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
            $promotionImageController->deleteImageByPromotionId($promotion->getPromotionId());
            foreach ($promotionImageList as $promotionImage) {
                unlink($promotionImage->getImagePath());
            }
//            delete promotion folder
            rmdir("../user_upload/" . $account->getAccountId() . "/promotions/" . $promotion->getPromotionId());
            rmdir("../user_upload/" . $account->getAccountId() . "/promotions/");
        }
//        delete promotion
        $deletePromotion = PromotionController::deletePromotionByShopId($account->getAccountId());

        //        delete shop image
        $shopImageController = new ShopImageController();
        foreach ($shopImageController->getImageByAccountId($account->getAccountId()) as $imageAccount) {
            unlink($imageAccount->getImagePath());
        }
//        delete account folder
        rmdir("../user_upload/" . $account->getAccountId() . "/shop_images");
        rmdir("../user_upload/" . $account->getAccountId());

        $deleteShopImage = $shopImageController->deleteShopImageByShopId($account->getAccountId());
//        delete shop info
        $deleteShopInfo = ShopInformationController::deleteShopInformation($account->getAccountId());
//        delete log
        $deleteLog = ActivitiesLogController::deleteLogByAccountId($account->getAccountId());
//        delete account
        $deleteAccount = AccountController::deleteAccount($account->getAccountId());

        if ($deleteShopInfo == true && $deleteAccount == true) {
            $_SESSION['manageAccountStatus'] = "true";
            $_SESSION['manageAccountAction'] = "delete";
        }
        header("Refresh:0");
        exit;
    } else if (isset($_POST['enable'])) {
//        $actionDetail = "enable deleted user in account list [".$adminController->getAccountById($_POST['userId'])->getName()."]";
//        ActivitiesLogController::addLog(new ActivitiesLog('', $account->getAccountId(),'delete','account',$actionDetail,''));
        header("Location: account_list.php");
        exit;
    }
}
?>

<html>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div style="margin-top: 80px;">

</div>
<?php

if (isset($_SESSION['manageAccountStatus']) && isset($_SESSION['manageAccountAction'])) {
    if ($_SESSION['manageAccountStatus'] == true) {
        if ($_SESSION['manageAccountAction'] == "delete") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Deleting account <strong>successful!</strong>
                </div>
            ');
        } elseif ($_SESSION['manageAccountAction'] == "add") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Adding account <strong>successful!</strong>
                </div>
            ');
        } elseif ($_SESSION['manageAccountAction'] == "edit") {
            echo('
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Updating account <strong>successful!</strong>
                </div>
            ');
        } else {

        }
    }
    unset($_SESSION['manageAccountStatus']);
    unset($_SESSION['manageAccountAction']);
}

?>
<div class="container-fluid">
    <h2 class="col-md-11">Accounts</h2>
    <a class="btn btn-default col-md-1" href="add_account.php" role="button">New Account</a>
    <table class="col-md-12 table table-condensed table-hover">
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Role</th>
            <th>Join Date</th>
            <th>Shop name</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $accountList = AccountController::getAllAccount();
        foreach ($accountList as $account) {
            $shopInfo = ShopInformationController::getShopInformationById($account->getAccountId());
            $shopName = '-';
            $shopImageList = array();
            $shopImageController = new ShopImageController();


            if ($shopInfo->getName() != null) {
                $shopName = "<a href='profile.php?accountId=".$shopInfo->getAccountId()."' >".$shopInfo->getName()."</a>";
            }
            $imageList = $shopImageController->getImageByAccountId($account->getAccountId());
            if ($shopImageController->getImageByAccountId($account->getAccountId()) != null) {
                foreach ($imageList as $image) {
                    $shopImageList[] = $image->getImagePath();
                }
            }

            Adaptor::setStatus($account->getStatus());
            echo '<tr>
                <td>' . $account->getAccountId() . '</td>
                <td>' . $account->getEmail() . '</td>
                <td>' . $account->getRole() . '</td>
                <td>' . $account->getJoinDate() . '</td>
                <td>' . $shopName . '</td>
                <td class="col-md-4">';
            foreach ($shopImageList as $aImage) {
                echo '<img class="col-md-3" src="' . $aImage . '">';
            }
            echo '</td><td>' . Adaptor::getStatus() . '</td>';
            if ('admin' == $account->getRole()) {
                echo '<td>
                            <form name=deleteuser action=""method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button style="color: lightgrey;" type=submit disabled><span class="glyphicon glyphicon-edit"></span></button>
                                <button style="color: lightgrey;" name="delete" type=submit disabled><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                            </td>';
            } else if (0 == $account->getStatus()) {
                echo '<td>
                            <form name=deleteuser action=""method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button style="color: lightgrey;" type=submit disabled><span class="glyphicon glyphicon-edit"></span></button>
                                <button type=submit name="enable" class="btn btn-success btn-xs">Enable</button>
                            </form>
                        </td>';
            } else if (1 == $account->getStatus()) {
                echo '
                        <td>
                            <form name=deleteuser action=""method="post">
                                <input type=hidden value=' . $account->getAccountId() . ' name="userId" >
                                <button name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button  onclick="show_alert();" name="delete" type=submit><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </td>';
            }
            echo '</tr>';
        } ?>
    </table>
</div>
<script>
    function show_alert() {
        if (confirm("Do you really want to delete this account?"))
            document.forms.name("deleteuser").submit();
        else
            return false;
    }
</script>
</body>
</html>
