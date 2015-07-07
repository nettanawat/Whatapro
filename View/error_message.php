<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAP</title>
    <?php

    $assetPath = '';

    include_once '../assets.php'

    ?>

    <?php
    printf($_SESSION['redirect']);
    ?>
</head>
<body>
<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-danger">Waring message</h2>
            </div>
            <div class="col-md-12">
                <?php printf("<p class='text-danger'> ".$_SESSION['error_message']." </p>");
                ?>
            </div>
        </div>
    </div>

</div> <!-- /container -->
</body>
</html>