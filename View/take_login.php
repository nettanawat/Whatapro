<?php

include dirname(__FILE__) . '/../Config.php';
session_start();
if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $loginAccount = AccountController::doLogin($email, $password);
    $_SESSION['user'] = $loginAccount;
    if ($loginAccount != null ) {
        if ('admin' == $loginAccount->getRole()) {
            $actionDetail = "log in to system by [" . $loginAccount->getEmail() . "]";
            ActivitiesLogController::addLog(new ActivitiesLog('', $loginAccount->getAccountId(), 'login', 'account', $actionDetail, ''));
            header('Location: home_admin.php');
        } else {
            $actionDetail = "log in to system by [" . $loginAccount->getEmail() . "]";
            ActivitiesLogController::addLog(new ActivitiesLog('', $loginAccount->getAccountId(), 'login', 'account', $actionDetail, ''));
            header('Location: home.php');
        }
    } else {
        header('Location: error_login.php');
        exit;
    }
}
