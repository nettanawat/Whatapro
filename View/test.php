<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/25/15 AD
 * Time: 12:34 PM
 */

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Bangkok'));    // Another way
echo($now->format('Y-m-d H:i:s'));