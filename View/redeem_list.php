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
<div class="container-fluid">
    <h2 class="col-md-11">Redeem Codes</h2>

    <!--    search-->
    <div style="padding-bottom: 20px;" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" id="inputSearch" placeholder="What is in your mind?">
        </div>
        <div class="form-group">
            <button class="form-control btn btn-default" id="btnSearch"><span class="glyphicon glyphicon-search"></span> Search</button>
        </div>
    </div>

    <table class="col-md-12 table table-condensed table-hover">
        <tr>
            <th>Id</th>
            <th>Owner</th>
            <th>Code</th>
            <th>Barcode</th>
            <th>Generate date</th>
            <th>Point amount</th>
            <th>Status</th>
        </tr>
        <?php

        $redeemCodeList = RedeemCodeController::getAllRedeemCode();

        foreach($redeemCodeList as $redeem){
            echo('<tr>
                    <td>'.$redeem->getId().'</td>
                    <td>'.$redeem->getOwner().'</td>
                    <td><label style="font-size: 15px;" class="label label-primary">'.$redeem->getCode().'</label></td>
                    <td>'.$redeem->getBarcodePath().'</td>
                    <td>'.$redeem->getGenerateDate().'</td>
                    <td>'.$redeem->getPointAmount().'</td>
                    <td>'.$redeem->getStatus().'</td>
            </tr>');
        }
        ?>
    </table>

</div>
</body>
</html>
