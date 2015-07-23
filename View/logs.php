<!DOCTYPE html>
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
<html>
<head>
    <title>WAP / Home</title>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>
</head>
<body>
<div style="margin-top: 80px;" class="container-fluid">
    <h2 class="col-md-12">Logs</h2>
    <table id="tableOne" class="table table-hover table-condensed col-md-12">
        <tr>
            <th>Id</th>
            <th>Method</th>
            <th>Module</th>
            <th>User</th>
            <th>Action Detail</th>
            <th>Date</th>
        </tr>
        <?php
        $activityList = ActivitiesLogController::getAllLog();
        foreach ($activityList as $activity) {
            $account = AccountController::getAccountById($activity->getAccountId());
            echo "
                    <tr>
                        <td>" . $activity->getId() . "</td>
                        <td>" . $activity->getMethod() . "</td>
                        <td>" . $activity->getModule() . "</td>
                        <td><a href='".Config::PATH."/account/".$account->getAccountId()."'>" . $account->getEmail()  . "</a></td>
                        <td>" . $activity->getDetail() . "</td>
                        <td>" . $activity->getDate() . "</td>
                    </tr>
            ";
        }
        ?>
</div>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>