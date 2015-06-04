<?php
    include_once 'session.php';
?>
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
                    <ul class="nav navbar-nav">
                        <li><a href="home.php">Dashboard</a></li>
                        <li class="dropdown">
                                <li><a href="promotion_list.php">Manage Promotion</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php
                                echo("".$logInAccount->getEmail());
                            ?>
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="edit_profile.php">Edit profile</a></li>
                                <li><a href="take_logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
