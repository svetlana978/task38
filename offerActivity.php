<?php 
session_start();
//$_SESSION['auth'] = 0;
var_dump(1);
$host = 'localhost';
$user_enter = 'root';
$password_enter = 'root';
$dbName = 'test';
mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
$link = mysqli_connect($host, $user_enter, $password_enter, $dbName)
    or die(mysqli_error($link));

mysqli_query($link, "SET NAMES 'utf8'");

    $offer_id = $_SESSION['offer_id'];
    var_dump(2);
    
    $query_current_activity = "SELECT activity FROM offers WHERE id = $offer_id";
    $activity = mysqli_query($link, $query_current_activity) or die(mysqli_error($link));
    if (mysqli_fetch_assoc($activity) == 'YES') 
        $query_change_activity = "UPDATE offers SET activity = 'NO' WHERE id = $offer_id";
    else 
        $query_change_activity = "UPDATE offers SET activity = 'YES' WHERE id = $offer_id";
    
    $result = mysqli_query($link, $query_change_activity) or die(mysqli_error($link));
  

 
?>