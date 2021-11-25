<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SF-AdTech</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="offerActivity.js"></script>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container pt-4">
    <h1 class="mb-4"><a href="<?php echo URL; ?>">Offer</a></h1>

    <div class="mb-4">
        <?php $link = mysqli_connect("localhost", "root", "root", "test") or die(mysqli_error($link)); 
                if ($_SESSION['auth'] == 1) {
                    $id_owner = $_SESSION['user_id'];
                    
                    $query = "SELECT * FROM offers WHERE id_owner='$id_owner'";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
                    //  var_dump($result);
                     if($result != NULL) { 
                         $i = 0;
                         for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) {
                            if ($data == [])
                            echo "<table><tr><th>Название</th><t><th>Стоимость</th><th>Url</th><th>Тема</th><th>Число подписчиков</th><th>Активность</th></tr>";
                    //  вывод таблицы в задании 23.6
                            echo "<tr>";
                            echo "<td>" . $row['offer_name'] . "</td>";
                            echo "<td>" . $row['cost'] . "</td>";
                            echo "<td>" . $row['offer_url'] . "</td>";
                            echo "<td>" . $row['theme'] . "</td>";
                            echo "<td>" . $row['subscribers'] . "</td>";
                            echo "<td>" . $row['activity'] . "</td>";
                           ?><td> <button id="offer_activity">Disactive</button></td>
                            <!-- <input type="button" value="x"></input> -->
                            <?php  echo "</tr>";
                            // $_SESSION['offer_id'] = $i;
                            //  echo $i . '  ';
                            // $i++;
                            //  echo $i;
                        }
                        echo "</table>";
                                                 
                         } else { ?>
                        <div class="alert alert-secondary">Нет созданных offer-ов</div>  
                        <?php } ?>              
                        <a href="http://task38/task23.9-master/newOffer.php">Создать новый offer</a>      
                <?php } else { ?>
                    <p>Пожалуйста, войдите в аккаунт или зарегистрируйтесь</p>
                <?php } ?>
    </div>

    
    

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>

</body>
</html>
