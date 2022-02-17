<?php
session_start();

$host = 'localhost';
$user_enter = 'root';
$password_enter = 'root';
$dbName = 'test';
mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
$link = mysqli_connect($host, $user_enter, $password_enter, $dbName)
     or die(mysqli_error($link));

mysqli_query($link, "SET NAMES 'utf8'");

$offer_name = $_POST['of_name'];

$query_current_activity = "SELECT `activity` FROM `offers` WHERE `offer_name` = '$offer_name'";
$activity = mysqli_query($link, $query_current_activity) or die(mysqli_error($link));
$a = current(mysqli_fetch_assoc($activity)); 
echo $a;
 
?>