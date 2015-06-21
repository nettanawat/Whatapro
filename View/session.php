<?php

include dirname(__FILE__) . '/../Config.php';
session_start();

// user 
$user_type = "user";
if (isset($_SESSION['userId'])) {
    $logInAccount = AccountController::getAccountById($_SESSION['userId']);

    // if account is admin
    if('admin' == $logInAccount->getRole()){
        $user_type = 'admin';
    }
} else {
    header('Location: error_login.php');
//    header('Location: index.php');
    exit;
}

//  user vs admin menu
if ("user" == $user_type) {
    include_once 'menus.php';
} else {
    include_once 'menus_admin.php';
}