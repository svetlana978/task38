<?php
session_start();

include "dbConnect.php";
if ($_SESSION['auth'] == 1) {
    $id_owner = $_SESSION['user_id'];
    
    $query = "SELECT * FROM offers WHERE id_owner='$id_owner'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
    //  var_dump($result);
        if($result != NULL) { 
        //  $i = 0;
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
                $of_name =  $row['offer_name']; 
                // $id = 'offer_activity_' . $i;
                ?>
                    <!-- <td><input  id="" type="checkbox" name="delete" ></input> </td> -->
                <td><input  id="<?php echo $of_name ?>" type="button" name="activity" ></input> </td>
                <?php  echo "</tr>";
                // $_SESSION['i'] = $id;
                //  echo $i . '  ';
                //  $i++;
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