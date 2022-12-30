<?php
    session_start();
    // підключаємося до бази данних
    // require_once '/registration/connect.php';
    $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');
    
    // заносимо значення з форми регістрації у змінні
    $ntitle = $_POST['ntitle'];
    $ntext = $_POST['ntext'];
    $author = $_SESSION['user']['full_name'];
    $ndate = date("Y-m-d H:i:s");
    
    
       $tquery = 'SELECT MAX(news_id) AS lastbill FROM news';
       $row = mysqli_fetch_assoc(mysqli_query($connect,$tquery));
       $nextbillno = $row['lastbill'];
       $id = $nextbillno + 1;
        
        mysqli_query($connect, "INSERT INTO `news` (`news_id`, `ntext`, `ntitle`, `ndate`, `author`) VALUES ('$id', '$ntext', '$ntitle', '$ndate', '$author')");

        $_SESSION['message2'] = 'Ваш допис успішно доданий';
    
        exit("<meta http-equiv='refresh' content='0; url=index.php'>");
    ?>