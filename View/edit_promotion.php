<?php
include_once 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAP / Add Promotion</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="row">
            <form role="form" name="signupform" action="take_edit_promotion.php" method="post">
                <?php
                if ('admin' != $user_type) {
                    $adminController = new AdminController();
                    $promotion = $adminController->getPromotionById($_GET['promotion_id']);
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['promotion_id'] = $promotion->getPromotionId();
                    ?>
                <div class="col-md-12">
                    <label class="titleFontSize">Edit promotion</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nameLabel">Promotion By</label>
                        <input type="text" class="form-control" name="inputName" required value="<?php echo $adminController->getAccountById($promotion->getAccountId())->getName();?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="promotionLabel">Promotion name</label>
                        <input type="text" class="form-control" name="inputPromotionName" required value="<?php echo $promotion->getName(); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailBabel">Description</label>
                        <textarea class="form-control" rows="3" name="inputDescription" required><?php echo $promotion->getDescription(); ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Browse Image</label>
                        <input type="file" name="img">
                    </div>
                </div>


                    <?php

                } else if (1 == $user_type) {

                    $accountController = new AccountController();
                    $promotion = $accountController->getPromotionById($_GET['promotion_id']);
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['user_id'] = $account->getAccountId();
                    $_SESSION['promotion_id'] = $promotion->getPromotionId();
                    ?>

                    <div class="col-md-12">
                        <label class="titleFontSize">Edit promotion</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="namelabel">Promotion name</label>
                            <input type="text" class="form-control" name="inputPromotionName" required value="<?php echo $promotion->getName(); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailLabel">Description</label>
                            <textarea class="form-control" rows="3" name="inputDescription" required><?php echo $promotion->getDescription(); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Browse Image</label>
                            <input type="file" name="img">
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="startDateLabel">From</label>
                        <input type="date" class="form-control" name="inputDateFrom" required value="<?php echo $promotion->getStartDate(); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="endDateLabel">To</label>
                        <input type="date" class="form-control" name="inputDateTo" required value="<?php echo $promotion->getEndDate(); ?>">
                    </div>
                </div>
        </div>
        <div class="col-md-1">
            <a class="btn btn-default" href="promotion_list.php" role="button">Back</a>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

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