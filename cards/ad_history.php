<?php
    session_start();
    // підключаємося до бази данних
    // require_once '/registration/connect.php';
    $id = $_GET['id'];
    $history2 = $_POST['history2'];
    $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');
    $user = mysqli_query($connect, "SELECT `card_id`,`ful_clent_name`,`date_of_birth`,`adress`,`email`,`phone`,`status`,`doctor_id`,`history` FROM `cards` WHERE `card_id` = '$id'");
    $num_rows = mysqli_query($connect, "SELECT count(*) FROM `cards` WHERE `card_id` = '$id'");
    // $author = $_SESSION['user']['full_name'];
    // $ndate = date("Y-m-d H:i:s");
    $row = $num_rows->fetch_row();
    $count = $row[0];
    $author = $_SESSION['user']['full_name'];
    $ndate = date("Y-m-d H:i:s");
    // echo $count
    if($count > 0){

        $users = mysqli_fetch_assoc($user);
    }
    // print_r($users);
    // $hstt = "<p>".$users['history']."</p><p>".$history2."<p style='color:gray;'>" . $author . "; " . $ndate . "</p></p>";
    $hstt = '<p>'.$users['history'].'</p><p>'.$history2.'<br><span style="color:gray;font-size:12px;">'.$author."; ".$ndate."</span></p>";
    print($hstt);
    
    //    $tquery = 'SELECT MAX(news_id) AS lastbill FROM news';
    //    $row = mysqli_fetch_assoc(mysqli_query($connect,$tquery));
    //    $nextbillno = $row['lastbill'];
    //    $id = $nextbillno + 1;
        
        mysqli_query($connect, "UPDATE `cards` SET `history`='$hstt' WHERE `card_id`='$id'");

        // $_SESSION['message2'] = 'Ваш допис успішно доданий';
    
        exit("<meta http-equiv='refresh' content='0; url=index4.php?time=$id'>");
    ?>