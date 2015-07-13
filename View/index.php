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
        <div style="margin-top: 150px; color: #ffffff" class="container">
            <!-- Main component for a primary marketing message or call to action -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>WAP</h2>
                    </div>
                    <div class="col-md-6">
                        <p>Welcome to What a pro.<br> Start a promotion, give them your offer, and be in the know.</p>
                        <p>
                            <a style="color: #000000" class="btn btn-lg btn-warning" href="<?php echo Config::PATH; ?>/register" role="button">Join WAP &raquo;</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo Config::PATH; ?>/login" name="loginform">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="inputEmail" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="inputPassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button style="color: #000000" type="submit" class="btn btn-warning">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div> <!-- /container -->
    </body>
</html>