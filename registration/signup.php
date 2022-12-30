<?php
    session_start();
    // підключаємося до бази данних
    require_once 'connect.php';
    
    // заносимо значення з форми регістрації у змінні
    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $status = $_POST['status'];
    
    // перевіряжмо чи збігаються паролі
    if($password === $password_confirm){

       $tquery = 'SELECT MAX(id) AS lastbill FROM users';
       $row = mysqli_fetch_assoc(mysqli_query($connect,$tquery));
       $nextbillno = $row['lastbill'];
       $id = $nextbillno + 1;
        
        $password = md5($password);
        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `status`) VALUES ('$id', '$full_name', '$login', '$email', '$password','$status')");

        $_SESSION['message'] = 'Реєстрація пройшла успішно';
        // header('Location: index2.php')
        exit("<meta http-equiv='refresh' content='0; url=/registration/index2.php'>");

    } else {
        $_SESSION['message'] = 'Паролі не співпадають';
        // header('Location: register.php')
        exit("<meta http-equiv='refresh' content='0; url=/registration/register.php'>");
    }

    ?>