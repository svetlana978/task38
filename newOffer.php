<?php 
session_start();
//$_SESSION['auth'] = 0;

$host = 'localhost';
$user_enter = 'root';
$password_enter = 'root';
$dbName = 'test';
mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
$link = mysqli_connect($host, $user_enter, $password_enter, $dbName)
    or die(mysqli_error($link));

mysqli_query($link, "SET NAMES 'utf8'");
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $url = $_POST['url'];
    $theme = $_POST['theme'];
    $id_owner = $_SESSION['user_id'];

    $query = "INSERT INTO offers (offer_name, cost, offer_url, theme, id_owner, subscribers, activity) VALUES ('$name', '$cost', '$url', '$theme', '$id_owner', 0, 'YES')";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    header("Location: index.php");

 
}
?>


<form method="post">
    <p>Имя offer-а: 
        <input type="text" name="name" />
    </p>
    <p>Стоимость перехода: 
       <input type="text" name="cost" />
    </p>
    <p>Целевой URL: 
        <input type="text" name="url" />
    </p>
    <p>Тема сайта: 
        <input type="text" name="theme" />
    </p>
    <input type="submit" name="submit" value="Создать новый offer">
    
</form>
     
