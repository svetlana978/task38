<?php 
$link = mysqli_connect("localhost", "root", "root", "test");
$id_owner = $_SESSION['user_id'];
$query = mysqli_query($link,"SELECT offer_name, cost, offer_url, theme FROM offers WHERE id_owner='$id_owner'");
$result = mysqli_fetch_assoc($query); 

if($result != NULL) { 
    foreach($result as $key => $row)
    {
        print($row);
       //  $offer_name = $result['offer_name'];
       //  $cost = $result['cost'];
       // $offer_url = $row["offer_url"];
       // $theme = $row["theme"];
       // print($cost);
    }                     
    }         
                       
                       
                       
                       
                       
                       
?>