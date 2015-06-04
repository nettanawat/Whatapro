<?php

include dirname(__FILE__) . '../Config.php';
$adminController = new AdminController();
if ($_POST['action'] == 'approve') {
    $adminController->approveSignupRequest($_POST['inputId']);
    $adminController = new AdminController();
    $requestInformation = $adminController->getRequestDetail($_POST['inputId']);
    $adminController->addNewAccount(new AccountInfo("",$requestInformation->getEmail(), $requestInformation->getPassword(), 1, $requestInformation->getName(), Date("Y-m-d"), 1),
        new ShopInformation("","", $requestInformation->getPhoneNumber(), $requestInformation->getSubDistrict(), $requestInformation->getLatitude(), $requestInformation->getLongitude(), $requestInformation->getOpenTime(), $requestInformation->getDescription(), $requestInformation->getImage()));
    header('Location: request_signup_list.php');
    exit;
}
if ($_POST['action'] == 'delete') {
    $adminController->denineSingupRequest($_POST['inputId']);
    header('Location: request_signup_list.php');
    exit;
} else {
    //invalid action!
}
?>
