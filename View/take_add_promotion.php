<?php

include dirname(__FILE__) . '/../Config.php';
//var_dump($_POST);
$shop = $_POST['comboShop'];
$name = $_POST['inputName'];
$description = $_POST['inputDescription'];
$startDate = $_POST['inputDateFrom'];
$endDate = $_POST['inputDateTo'];
if(strtotime($startDate) > strtotime($endDate)){
    session_start();
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=add_promotion.php'>";
    $_SESSION['error_message'] = "Start date cannot greater than end date";
    header('Location: error_message.php');
    exit;
}
$accountController = new AccountController();
$accountController->addNewPromotion(new Promotion("", $shop, $name, $description, null, null, $startDate, $endDate, 1));
header('Location: promotion_list.php');
exit;