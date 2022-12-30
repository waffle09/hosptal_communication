<?php
    session_start();
    if($_SESSION['user']){
        header('Location: profile.php');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=Au">
    <link href="regstl.css" rel="stylesheet">
    <title>Registration</title>
</head>
<body>
    <form action="/registration/signup.php" method="post">
        <label>ПІБ</label>
        <input type = "text" name = "full_name" required placeholder = "Введіть своє повне ім'я">
        <label>Логін</label>
        <input type = "text" name = "login" required placeholder = "Введіть логін">
        <label>Пошта</label>
        <input type = "email" name = "email" required placeholder = "Введіть адресу електронної пошти">
        <label>Посада</label>
        <input type = "status" name = "status" required placeholder = "Введіть свою посаду в компанії">
        <label>Пароль</label>
        <input type = "password" name = "password" required placeholder = "Введіть пароль">
        <label>Підтвердження пароля</label>
        <input type = "password" name = "password_confirm" required placeholder = "Повторіть пароль ще раз">
        <button type="submit" style="margin: 10px 0; padding: 10px; border: unset; background-color:mediumaquamarine; border-bottom: 2px solid #e3e3e3;outline: none;">Зареєструватися</button>
        <p> У вас вже є акаунт? - <a href = "/registration/index2.php">Авторизуйтеся</a>!</p>
        <!-- Відображення повідомлень про помилку  -->
        <?php
            if($_SESSION['message']){
                echo '<p class="msg">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']); 
        ?>
    </form>
    
</body>
</html>
