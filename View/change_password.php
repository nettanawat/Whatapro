<?php
include_once 'session.php';

if(isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    AccountController::changePassword(new AccountInfo($logInAccount->getAccountId(),"",$_POST['password'],"","",""));
    $_SESSION['changePassword'] = "true";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>WAP / Change Password</title>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div style="margin: 80px;" class="container-fluid">
    <?php
     if(isset($_SESSION['changePassword'])){
         echo('<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Changing password <strong>successful!</strong>
                </div>');
     }
    ?>
        <div class="row">
            <div class="col-md-12">
                <label class="titleFontSize">Change Password</label>
            </div>
            <div class="registrationFormAlert" id="divCheckPasswordMatch">
            </div>
            <form name="changePasswordForm" id="changePasswordForm" action="" method="post">
                <div class="col-md-6">
                    <div class="form-group password">
                        <label class="control-label" for="inputError2">New Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group confirmPassword">
                        <label class="control-label" for="inputError2">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="submit" onclick="checkAndSubmit()" name="change" class="btn btn-default" value="Change password"/>
                </div>

            </form>
        </div><!-- /row -->
</div> <!-- /container -->

<script type="text/javascript">
$(document).ready(function () {
    $("#confirmPassword").keyup(checkPasswordMatch);
    $("#password").keyup(checkPasswordMatch);
});

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword){
        $(".password").addClass("has-error has-feedback");
        $(".confirmPassword").addClass("has-error has-feedback");
    } else{
        $(".password").addClass("has-success").removeClass("has-error").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
        $(".confirmPassword").addClass("has-success").removeClass("has-error").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
    }
}

    function checkAndSubmit(){
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        if(password == confirmPassword) {
            $( "#changePasswordForm" ).submit();
        }
    }
</script>
</body>
</html>