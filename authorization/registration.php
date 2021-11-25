<?php
session_start();


// Страница регистрации нового пользователя 
// Соединяемся с БД
// mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "root", "test"); 
if(isset($_POST['submit']))
{
    $err = [];
    // проверяем логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    } 
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    } 
    // проверяем, не существует ли пользователя с таким именем
    $log = $_POST['login'];
    $query = "SELECT user_id FROM users WHERE login = '$log'";
    $result = mysqli_query($link, $query);
    
    if(mysqli_fetch_assoc($result) != NULL)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    } 
    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $login = $_POST['login'];
        // Убираем лишние пробелы и делаем двойное хэширование (используем старый метод md5)
        $password = md5(md5(trim($_POST['password']))); 
        mysqli_query($link,"INSERT INTO users SET login='$login', password='$password'");
         
        $query = mysqli_query($link,"SELECT user_id FROM users WHERE login='$log'");
        $_SESSION['auth'] = 1;
        $_SESSION['user_id'] = mysqli_fetch_assoc($query); 
        $_SESSION['login'] = $log;
        header("Location: http://task38/task23.9-master/"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?> 
<form method="POST">
<input type="text" name="login" placeholder="Логин" required><br/>
<input type="password" name="password" placeholder="Пароль" required> <br>
<input name="submit" type="submit" value="Зарегистрироваться"><br/>
<br/><a href="login.php"> Войти
</form>
