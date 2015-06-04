<?php

include dirname(__FILE__) . '../Config.php';

if ($_POST['inputPassword'] == $_POST['inputPasswordAgain']) {
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $name = $_POST['inputName'];
    $phoneNumber = $_POST['inputPhoneNumber'];
    $subDistrict = $_POST['comboDistrict'];
    $latitude = $_POST['inputLatitude'];
    $longitude = $_POST['inputLongitude'];
    $openTime = $_POST['inputOpenAndCloseTime'];
    $description = $_POST['inputDescription'];
    $image = NULL;
    $requestDate = Date("Y-m-d");
    $approveDate = NULL;
    $manageBy = NULL;
    $status = 0;
    $accountController = new AccountController();
    $accountController->sentRequestToSingup(new RequestSignupInfo("", $email, $password, $name, $phoneNumber, $subDistrict, $latitude, $longitude, $openTime, $description, NULL, $requestDate, $approveDate, $manageBy, $status));
    header('Location: index.php');
    exit;
} else {
    header('Location: register_request.php');
    exit;
}
?>
