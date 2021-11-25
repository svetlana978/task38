<?php
session_start();

$_SESSION['auth']=0;
$token = hash('gost-crypto', random_int(0,999999));
$_SESSION["CSRF"] = $token;
//session_destroy();

// Страница авторизации 
// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
} 


// Соединяемся с БД
$link = mysqli_connect("localhost", "root", "root", "test"); 

if(isset($_POST['submit']))
{
   // echo $_POST["token"] . '  ';
   // echo $_SESSION["CSRF"];
    //if($_POST["token"] == $_SESSION["CSRF"])
    //{
        //Начинаем проверку логина и пароля в БД

        // Вытаскиваем из БД запись, у которой логин равняется введенному
        $log = $_POST['login'];
        $query = mysqli_query($link,"SELECT user_id, password FROM users WHERE login='$log'");
        $data = mysqli_fetch_assoc($query); 
        
        // Сравниваем пароли
        if($data['password'] === md5(md5($_POST['password'])))
        {
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));
  
          //  if(!empty($_POST['remember_me']))
            if(isset($_POST["remember_me"])){
            
                $password_cookie_token = md5($array_user_data["id"].$password.time());
 
                //Добавляем созданный токен в базу данных
                $update_password_cookie_token = mysqli_query($link, "UPDATE users SET cookie_token='".$password_cookie_token."' WHERE login = '".$log."'");
             
                if(!$update_password_cookie_token){
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] = "<p class='mesage_error' >Ошибка функционала 'запомнить меня'</p>";
                     
                    //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: index.php");
             
                    //Останавливаем скрипт
                    exit();
                }

                //Устанавливаем куку с токеном
                setcookie("password_cookie_token", $password_cookie_token, time() + (1000 * 60 * 60 * 24 * 30));
            } else {
                    //Если галочка "запомнить меня" небыла поставлена, то мы удаляем куки
                if(isset($_COOKIE["password_cookie_token"])){
                
                        //Очищаем поле password_cookie_token из базы данных
                    $update_password_cookie_token = mysqli_query($link, "UPDATE users SET cookie_token = '' WHERE login = '".$log."'");
                
                        //Удаляем куку password_cookie_token
                    setcookie("password_cookie_token", "", time() - 3600);
                }
                    
            }

        
        /*    // Записываем в БД новый хеш авторизации 
            mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'"); 
            // Ставим куки
            setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!! 
           

            // Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: check.php"); exit();*/ 
            $_SESSION['auth'] = 1;
            $_SESSION['user_id'] = $data['user_id']; 
            $_SESSION['login'] = $log;
            header("Location: http://task38/task23.9-master/"); exit();
        }
        
        else {
            print "Вы ввели неправильный логин/пароль";
        }
        
    //}
}
?>

<form method="post" action="">
<input type="text" name="login" placeholder="Логин" required><br/>
<input type="password" name="password" placeholder="Пароль" required> <br/>
<input type="hidden" name="token" value="<?=$token?>"> 
<label>
    <input type="checkbox" name="remember_me"> Запомнить меня
</label> <br/>
<input type="submit" name="submit" value="Войти"><br/><br/>
<a href="registration.php"> Зарегистрироваться
</form>