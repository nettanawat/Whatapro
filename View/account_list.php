<?php
include_once 'session.php';
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: '.Config::PATH.'/errormessage');
    exit;
}
if ('admin' == $user_type) {
    if (isset($_POST['edit'])) { //edit account
        header("Location: " .Config::PATH. "/account/edit/" . $_POST['userId']);
    }
}


?>

<html>
<head>
    <?php

    $assetPath = Config::PATH.'';

    include_once '../assets.php'

    ?>
</head>
<body>
<div style="margin-top: 50px;">

</div>
<?php

if (isset($_SESSION['manageAccountStatus']) && isset($_SESSION['manageAccountAction'])) {

    if($_SESSION['manageAccountAction'] == 'add') {
        echo '<input type="hidden" value="add" id="hiddenSession"';
    } else if($_SESSION['manageAccountAction'] == 'edit') {
        echo '<input type="hidden" value="edit" id="hiddenSession"';
    } else {
    }
    unset($_SESSION['manageAccountStatus']);
    unset($_SESSION['manageAccountAction']);
} else {
    echo '<input type="hidden" value="none" id="hiddenSession"';
}

?>
<div class="container-fluid">
    <div style="display: none;" id="updatesuccess" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Updating account <strong>successful!</strong></div>
    <div style="display: none;" id="addsuccess" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Adding account <strong>successful!</strong></div>


    <div id="top" class="col-md-12">
        <h2>Accounts</h2>
    </div>
    <form class="col-md-6" action="" style="padding-bottom: 20px;">
        <input type="text" class="form-control" id="inputSearch" onkeyup="searchData(this.value)" placeholder="Search account by email, shop name or account id">
    </form>
    <div class="col-md-6 text-right">
        <a class="btn btn-default" href="<?php echo Config::PATH.'/account/add'; ?>" role="button"><span class="glyphicon glyphicon-plus"></span> New Account</a>
    </div>

    <table class="col-md-12 table table-condensed table-hover">
        <tr id="tableHeader">
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
                $shopName = "<a href='".Config::PATH."/account/".$shopInfo->getAccountId()."' >".$shopInfo->getName()."</a>";
            }
            $imageList = $shopImageController->getImageByAccountId($account->getAccountId());
            if ($shopImageController->getImageByAccountId($account->getAccountId()) != null) {
                foreach ($imageList as $image) {
                    $shopImageList[] = $image->getImagePath();
                }
            }


            Adaptor::setStatus($account->getStatus());
            echo '<tr class="tableData" id="showData'.$shopInfo->getAccountId().'">
                <td>' . $account->getAccountId() . '</td>
                <td>' . $account->getEmail() . '</td>
                <td>' . $account->getRole() . '</td>
                <td>' . $account->getJoinDate() . '</td>
                <td>' . $shopName . '</td>
                <td class="col-md-4">';
            foreach ($shopImageList as $aImage) {
                //change path
                echo '<img class="col-md-3" src="' .Config::PATH.'/' .$aImage . '">';
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
                                <button class="editBtn" id='.Config::PATH . "/account/edit/" . $account->getAccountId() .' name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button class="deleteBtn" id="'. $account->getAccountId() .'" name="delete" type="button"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        </td>';
            }
            echo '</tr>';
        } ?>
    </table>
</div>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script>

    $("button.editBtn").click(function(e){
        $(location).attr('href', this.id);
    });

    $(document).ready(function () {
        var sessionAction = $("#hiddenSession").val();
        if(sessionAction == "add") {
            $("#addsuccess").show().delay(3000).fadeOut();
        } else if(sessionAction == "edit") {
            $("#updatesuccess").show().delay(3000).fadeOut();
        } else if(sessionAction == "none") {
        }
    });

    $("button.deleteBtn").click(function(e) {
        e.preventDefault();
        var accountId = this.id;
        if (confirm("Do you really want to delete this account?")) {
            $.ajax({
                method: "POST",
                url: "whatapro/view/take_delete_account.php",
                data: { userId: accountId, loginUserId: <?php echo $logInAccount->getAccountId();?>}
            }).done(function (deleteId) {
                    $('#showData' + deleteId).addClass(" danger").delay(2000).fadeOut(function() {
                        $(this.id).remove();
                    });
                    var showCompleteString = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Deleting account <strong>successful!</strong></div>'
                    $(showCompleteString).insertBefore('#top').delay(3000).fadeOut();
            });
        }
    });

    function searchData(data) {
        $.ajax({
            method: "GET",
            url: "whatapro/searchaccount",
            data: { key: data}
        })
            .done(function( msg ) {
                $('.tableData').remove();
                $( "#tableHeader" ).after(msg);
            });
    }
</script>
</body>
</html>
