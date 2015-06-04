<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: error_message.php');
    exit;
}
?>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div style="margin-top: 80px;" class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>5 Newest accounts</h3>
            <table class="table table-condensed table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join date</th>
                    <th>Status</th>
                </tr>
                <?php
                $amountOfAccounts = sizeof(AccountController::getAllAccount());
                $lastFiveAccounts = array_slice(AccountController::getAllAccount(), -5);
                $adaptor = new Adaptor();
                foreach ($lastFiveAccounts as $account) {
                    $adaptor->setStatus($account->getStatus());
                    $shopInfo = ShopInformationController::getShopInformationById($account->getAccountId());
                    $shopName = '-';
                    if($shopInfo->getName() != null){
                        $shopName = $shopInfo->getName();
                    }
                    echo '<tr>
                        <td>' . $account->getAccountId() . '</td>
                        <td>' . $shopName . '</td>
                        <td>' . $account->getEmail() . '</td>
                        <td>' . $account->getJoinDate() . '</td>
                        <td>' . $adaptor->getStatus() . '</td>
                        </tr>';
                } ?>
            </table>
            <div style="margin-top: -10px;" class="text-right">
                <a href="account_list.php" class="btn btn-default btn-sm">see more</a>
            </div>
        </div>

        <div class="col-md-6">
            <h3>5 Newest accounts</h3>
            <table class="table table-condensed table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                <?php
                $amountOfAccounts = sizeof(AccountController::getAllAccount());
                $lastFiveAccounts = array_slice(AccountController::getAllAccount(), -5);
                $adaptor = new Adaptor();
                foreach ($lastFiveAccounts as $account) {
                    $adaptor->setStatus($account->getStatus());
                    $shopInfo = ShopInformationController::getShopInformationById($account->getAccountId());
                    $shopName = '-';
                    if($shopInfo->getName() != null){
                        $shopName = $shopInfo->getName();
                    }
                    echo '<tr>
                        <td>' . $account->getAccountId() . '</td>
                        <td>' . $shopName . '</td>
                        <td>' . $account->getEmail() . '</td>
                        <td>' . $account->getRole() . '</td>
                        <td>' . $adaptor->getStatus() . '</td>
                        </tr>';
                } ?>
            </table>
            <div style="margin-top: -10px;" class="text-right">
                <a href="account_list.php" class="btn btn-default btn-sm">see more</a>
            </div>
        </div>
    </div> <!--row-->
</div><!--container-->
</body>
</html>
