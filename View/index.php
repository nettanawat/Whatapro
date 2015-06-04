<!DOCTYPE html>
<html>
    <head>
        <title>WAP / Index</title>
        <script src="../jquery.js"></script>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body class="adminBackground">
        <div style="margin-top: 150px; color: #ffffff" class="container">
            <!-- Main component for a primary marketing message or call to action -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>WAP</h2>
                    </div>
                    <div class="col-md-6">
                        <p>Welcome to What a pro.<br> Start a promotion, give them your offer, and be in the know.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="../View/register_request.php" role="button">Join WAP &raquo;</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <form class="form-horizontal" role="form" method="post" action="take_login.php" name="loginform">
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
                                    <button type="submit" class="btn btn-default">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </body>
</html>