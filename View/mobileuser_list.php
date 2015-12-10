<?php
include_once 'session.php';
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: '.Config::PATH.'/errormessage');
    exit;
}

?>
<html>
<head>
    <?php

    $assetPath = Config::PATH . '';

    include_once '../assets.php'

    ?>

</head>
<body>
<div style="margin-top: 50px;">

</div>

<div class="container-fluid">
    <div  id="top" class="col-md-12">
        <h2>Mobile user</h2>
    </div>

    <table class="col-md-12 table table-hover table-condensed">
        <tr id="tableHeader">
            <th>Id</th>
            <th>facebook id</th>
            <th>username</th>
            <th>point</th>
        </tr>

        <?php
            foreach(MobileUserController::getAllMobileUser() as $mobileUsers) {
                echo '<tr>';
                echo '<td>'.$mobileUsers->getId().'</td>';
                echo '<td>'.$mobileUsers->getFBid().'</td>';
                echo '<td>'.$mobileUsers->getFbUsername().'</td>';
                echo '<td>'.$mobileUsers->getPoint().'</td>';
                echo '</tr>';
            }
        ?>
    </table>
</div>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
