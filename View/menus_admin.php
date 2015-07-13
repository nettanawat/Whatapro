<?php
    include_once 'session.php';
?>
        <div class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <label class="navbar-brand">Admin panel</label>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo Config::PATH; ?>/admin"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                        <li><a href="<?php echo Config::PATH; ?>/accounts"><span class="glyphicon glyphicon-briefcase"></span> Account</a></li>
                        <li><a href="<?php echo Config::PATH; ?>/promotions"><span class="glyphicon glyphicon-star"></span> Promotion</a></li>
                        <li><a href="<?php echo Config::PATH; ?>/requests"><span class="glyphicon glyphicon-list"></span> Request</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-user"></span> Mobile user</a></li>
                        <li><a href="<?php echo Config::PATH; ?>/redeemcodes"><span class="glyphicon glyphicon-gift"></span> Redeem Code</a></li>
                        <li><a href="<?php echo Config::PATH; ?>/logs"><span class="glyphicon glyphicon-list-alt"></span> Activities Log</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $logInAccount->getEmail();?>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Config::PATH; ?>/changepassword"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
                                <li><a href="<?php echo Config::PATH; ?>/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>


