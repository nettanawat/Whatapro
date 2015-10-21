<?php
include dirname(__FILE__) . '/../Config.php';
session_start();
    if (0 == $_SESSION['user_type']) {
        $adminController = new AdminController();

        if(!isset($_POST['img']))
            $_POST['img'] = '';

        $adminController->editPromotion(new Promotion($_SESSION['promotion_id'], $_POST['inputName'], $_POST['inputPromotionName'], $_POST['inputDescription'], $_POST['img'], "", $_POST['inputDateFrom'], $_POST['inputDateTo'], null));
        header('Location: promotion_list.php');
        exit;
    } else if (1 == $_SESSION['user_type']) {
        $accountController = new AccountController();
        if(!isset($_POST['img']))
            $_POST['img'] = '';
        // fix id to name
        $actionDetail = "edit promotion [Owner: ".$_SESSION['user_id'].", Promotion name: ".$_POST['inputPromotionName']."]";
        $accountController->editPromotion(new Promotion($_SESSION['promotion_id'], $_SESSION['user_id'], $_POST['inputPromotionName'], $_POST['inputDescription'], $_POST['img'], "", $_POST['inputDateFrom'], $_POST['inputDateTo'], null));
        header('Location: promotion_list.php');
        exit;
    } else {

}