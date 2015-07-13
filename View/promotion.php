<?php
include_once 'session.php';

?>
<html>
<head>
    <?php

    $assetPath = Config::PATH . '';

    include_once '../assets.php'

    ?>
    <script type="text/javascript" src="../google_jsapi.js"></script>


</head>
<body>
<div style="margin: 55px;"></div>

<div style="padding-bottom: 30px;" class="container-fluid">
    <div class="row">

        <div style="height: 350px" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <?php
            echo '<ol class="carousel-indicators">';
            $promotion = PromotionController::getPromotionById($_GET['promotionId']);
            $shopInformation = ShopInformationController::getShopInformationById($promotion->getAccountId());
            $startDate = new DateTime($promotion->getStartDate());
            $startDate->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
            $endDate = new DateTime($promotion->getEndDate());
            $endDate->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way

            $promotionImageController = new PromotionImageController();
            $promotionImage = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
            $count = 0;
            foreach ($promotionImage as $imagePath) {
                if ($count == 0) {
                    echo '
                        <li data-target="#carousel-example-generic" data-slide-to="' . $count . '" class="active"></li>';
                } else {
                    echo '<li data-target="#carousel-example-generic" data-slide-to="' . $count . '"></li>';
                }
                $count++;
            }
            echo '</ol>';

            echo '<div style="height: 350px" class="carousel-inner" role="listbox">';
            $count = 0;
            foreach ($promotionImage as $imagePath) {
                if ($count == 0) {
                    echo '<div class="item active">
                    <img src="' . Config::PATH . '/whatapro/' . $imagePath->getImagePath() . '" alt="...">
                </div>';
                } else {
                    echo '<div class="item">
                    <img src="' . Config::PATH . '/whatapro/' . $imagePath->getImagePath() . '" alt="...">
                </div>';
                }
                $count++;
            }
            echo '</div>';

            ?>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!--image slide-->

        <div class="col-md-12 text-center">
            <h1><?php echo $promotion->getName()?></h1>
            <p>by</p>
            <h2><?php echo $shopInformation->getName()?></h2>
            <?php
            if ('admin' == $user_type) {
                echo '<a class="btn btn-default" href="'.Config::PATH.'/promotion/edit/'.$promotion->getPromotionId().'" >Edit this promotion</a>';
            }
            ?>
        </div>
        <div style="padding-top: 20px;" class="col-md-12">
            <div class="container ">
                <p style="font-size: 20px;" class="col-md-12"><?php echo $promotion->getDescription()?></p>
                <h4 class="col-md-6"><span class="glyphicon glyphicon-time"></span> <?php echo $startDate->format('l jS F Y').' - '; echo $endDate->format('l jS F Y');?></h4>
            </div>
        </div>

    </div>
    <!--row-->
</div>
<!--container-->
<div class="container-fluid text-center">
    <p>Copyright &copy; nettanawat 2015 All rights reserved</p>
</div>
<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo Config::PATH.'/promotions';?>"><strong style="text-decoration: none; color: orangered">Back</strong></a></li>
        </ul>
    </div>
</nav>
</body>
</html>
