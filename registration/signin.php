<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $num_rows = mysqli_query($connect, "SELECT count(*) FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $row = $num_rows->fetch_row();
    $count = $row[0];
    // echo $count
    if($count > 0){

        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = [
            "id"=>$user['id'],
            "full_name"=>$user['full_name'],
            "login"=>$user['login'],
            "email"=>$user['email'],
            "status"=>$user['status']
        ];
        // header('Location: profile.php')
        exit("<meta http-equiv='refresh' content='0; url=/registration/profile.php'>");

    } else {
        $_SESSION['message'] = 'Не правильний логін чи пароль';
        // header('Location: /index2.php')
        exit("<meta http-equiv='refresh' content='0; url=/registration/index2.php'>");
    }
    ?>