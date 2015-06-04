<?php
require_once 'entity/CheckInCodeDAOImpl.php';
mysql_connect("localhost","root","");
mysql_select_db("WAP");

$term=$_GET["term"];

$query=mysql_query("SELECT * FROM `Accounts` where `account_type`='1' ");
$json=array();



$checkin = new CheckInCodeDAOImpl();

echo $checkin->randomCode();