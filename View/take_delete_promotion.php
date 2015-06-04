<?php
include_once 'session.php';

if ($user_type == 0) {
    $adminController = new AdminController();
    $adminController->deletePromotion($_POST['promotion_id']);
    header('Location: promotion_list.php');
    exit;
} else {
    $accountController = new AccountController();
    $accountController->deletePromotion($_POST['promotion_id']);
    header('Location: promotion_list.php');
    exit;
}
