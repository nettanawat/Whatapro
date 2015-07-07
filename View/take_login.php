<?php

include dirname(__FILE__) . '/../Config.php';
session_start();
if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $loginAccount = AccountController::doLogin($email, $password);
    $_SESSION['userId'] = $loginAccount->getAccountId();
    if ($loginAccount != null ) {
        if ('admin' == $loginAccount->getRole()) {
            $actionDetail = "logged in to system";
            ActivitiesLogController::addLog(new ActivitiesLog('', $loginAccount->getAccountId(), 'login', 'account', $actionDetail, ''));
            header('Location: '.Config::PATH.'/admin');
        } else {
            $actionDetail = "logged in to system";
            ActivitiesLogController::addLog(new ActivitiesLog('', $loginAccount->getAccountId(), 'login', 'account', $actionDetail, ''));
            header('Location: '.Config::PATH.'/user');
        }
    } else {
        header('Location: errorlogin.php');
        exit;
    }
}
