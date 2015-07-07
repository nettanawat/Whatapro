
<!DOCTYPE html>
<html>
    <head>
        <title>WAP</title>
        <?php

        $assetPath = '/whatapro';

        include_once '../assets.php'

        ?>
        <meta http-equiv="refresh" content="3; url=whatapro/">
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <label class="navbar-brand">What a pro</label>
                </div>
                <div class="navbar-collapse collapse">

                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div  style="margin: 80px;" class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-danger">Waring message</h2>
                    </div>
                    <div class="col-md-12">
                        <p class="text-danger">Invalid email or password or your account disabled by Administer</p>
                    </div>
                </div>
        </div> <!-- /container -->
    </body>
</html>