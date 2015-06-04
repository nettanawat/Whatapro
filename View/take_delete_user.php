<?php

include dirname(__FILE__) . '/../Config.php';

$adminCOntroller = new AdminController();
$adminCOntroller->deleteUser($_POST['userId']);

header('Location: account_list.php');
exit;