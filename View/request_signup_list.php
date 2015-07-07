<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=" . Config::PATH . "/user'>";
    header('Location: error_message.php');
    exit;
} else {
    if (isset($_POST['accept'])) {
        $request = RequestSignupController::getRequestById($_POST['requestId']);
        $accountId = AccountController::addNewAccount(new AccountInfo("", $request->getEmail(), $request->getPassword(), "user", null, 1));
        ShopInformationController::addShopInformation(new ShopInformation($accountId, $request->getName(), $request->getAddress(), $request->getPhoneNumber(), $request->getSubDistrict(), $request->getLatitude(), $request->getLongitude(), $request->getOpenTIme(), $request->getDescription(), null));
        RequestSignupController::acceptRequest($_POST['requestId']);
        ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"accept","account","accept request from [ request id : ".$_POST['requestId']." ]",null));
        header("Refresh: 0; url=" . Config::PATH . "/requests");
        exit;
    }
    if (isset($_POST['reject'])) {
        RequestSignupController::rejectRequest($_POST['requestId']);
        ActivitiesLogController::addLog(new ActivitiesLog("",$logInAccount->getAccountId(),"reject","account","reject request from [ request id : ".$_POST['requestId']." ]",null));
        header("Refresh: 0; url=" . Config::PATH . "/requests");
        exit;
    }
}

?>
<head>
    <?php
    $assetPath = Config::PATH . '';
    include_once '../assets.php'
    ?>
</head>
<body>
<div style="margin: 80px;" class="container-fluid">
    <div class="row">
        <h2>Request sign up</h2>
        <table class="col-md-12 table table-condensed table-hover">
            <tr>
                <th>Id</th>
                <th>Shop name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>Request date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            $requestList = RequestSignupController::getAllRequest();

            foreach ($requestList as $request) {
                Adaptor::setStatus($request->getStatus());
                echo('
                <tr>
                    <td>' . $request->getId() . '</td>
                    <td>' . $request->getName() . '</td>
                    <td>' . $request->getEmail() . '</td>
                    <td>' . $request->getPhoneNumber() . '</td>
                    <td><a id="shopaddress" href="" data-toggle="modal" data-target=".bs-example-modal-lg">' . $request->getAddress() . '</a>
                    <input type="hidden" class="address" value="' . $request->getAddress() . '">
                    <input type="hidden" class="latitude" value="' . $request->getLatitude() . '">
                    <input type="hidden" class="longitude" value="' . $request->getLongitude() . '"></td>
                    <td>' . $request->getRequestDate() . '</td>
                    <td>' . Adaptor::getStatus() . '</td>');
                if($request->getStatus() == 2){
                echo('<td><form name="manageForm" action="" method="post">
                        <input type="hidden" name="requestId" value="' . $request->getId() . '">
                        <button  class="clickReject" name="reject" type="submit"><span style="color:red;" class="glyphicon glyphicon-remove-circle"></span></button>
                        <button class="clickAccept" name="accept" type="submit"><span style="color:green;" class="glyphicon glyphicon-ok-circle"></span></button>
                    </form></td>');
                }
                else {
                    echo('<td>
                        <button disabled class="clickReject" name="reject" type="submit"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <button disabled class="clickAccept" name="accept" type="submit"><span class="glyphicon glyphicon-ok-circle"></span></button>
                    </td>');

                }
                echo('</tr>');
            }

            ?>
        </table>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">40 Nimmarnhemin Rd., T.Suthep, A.Muang, Chiang Mai, 50200</h4>
            </div>
            <div class="modal-body">
                <h2></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
