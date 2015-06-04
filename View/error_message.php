<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAP</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

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


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>