<?php

session_start();

include_once '../Config.php';

if(isset($_SESSION['userId'])){
    $account = AccountController::getAccountById($_SESSION['userId']);
    if('admin' == $account->getRole()) {
        header('Location: '.Config::PATH.'/admin');
    } elseif('user' == $account->getRole()) {
        header('Location: '.Config::PATH.'/user');
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>WAP / Index</title>
        <?php

            $assetPath = Config::PATH;

            include_once '../assets.php';
        ?>
    </head>
    <body>
    <video autoplay loop id="bgvid">
        <source src="whatapro/img/bg.m4v" type="video/mp4">
    </video>
    <div style="margin-top: 200px; padding-left: 150px; padding-right: 150px; color: #ffffff" class="container">
                <div class="row text-center">
<!--                    <div class="col-md-12">-->
<!--                        <img src="Whatapro/img/logo.png" class="displayed" width="150px;">-->
<!--                    </div>-->
                    <div style="font-family: quicksand; font-size: 60px; letter-spacing: -5px;" class="col-md-12 text-center">
                        <p style="margin-bottom: -10px; padding-top: 20px;">Digital Marketing</p>
                        <p>Made just for Promotions</p>
                    </div>
                    <a style="width: 200px;" class="joinus btn" href="<?php echo Config::PATH."/register"; ?>">Join us</a>
                </div>
        </div> <!-- /container -->
    <nav style="background-color: rgba(0,0,0,0.6); height: 100px;" class="navbar navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-md-12 text-center">
                <form style="margin-top: 30px;" class="form-inline" role="form" method="post" action="<?php echo Config::PATH; ?>/login" name="loginform">
                    <div class="form-group">
                            <input type="email" name="inputEmail" class="loginElement" placeholder="What is your email?" required>
                    </div>
                    <div class="form-group">
                            <input type="password" name="inputPassword" class="loginElement" placeholder="What is your password?" required>
                    </div>
                    <div class="form-group">
                        <button style="width: 100px;" type="submit" class="btn joinus">Sign in</button>
                    </div>
                </form>
            </div>
            <div style="margin-top: 5px; color: rgba(255,255,255,0.5)" class="col-md-12">
                <p>Copyright &copy; nettanawat 2015 All rights reserved</p>
            </div>
        </div>
    </nav>
    </body>
</html>