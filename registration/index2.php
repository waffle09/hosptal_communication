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
    <!-- <link href="style2.css" rel="stylesheet"> -->
    <link href="mstyle.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/69/69495.png" type="image/x-icon">
    <title>Authorization</title>
</head>
<body>
<div class="header">
        <h1>Hospital | The system of hospital communication</h1>
        </div>
        <div class="menu">
                <a class="a_menu" href="../index.php">Новини</a>
                <?php
                if($_SESSION['user']){
                echo '<a class="a_menu" href="../chat/index.php">Чат</a>';
                echo '<a class="a_menu" href="../cards/index4.php">E-Карти</a>';
                }
                ?>
                <a class="a_menu" href="\registration\index2.php">Профіль</a>
        </div>
    <!-- Registration form -->
    <div class="auth_form">
    <form action="/registration/signin.php" method="post">
        <label>Логін</label>
        <input type = "text" name = "login" required placeholder = "Введіть ваш логін">
        <label>Пароль</label>
        <input type = "password" name = "password" required placeholder = "Введіть ваш пароль">
        <button type="submit">Увійти</button>
        <p> У вас немає акаунту? - <a href = "/registration/register.php" class="reg_href">Зареєструйтеся</a>!</p>
        <?php
            if($_SESSION['message']){
                echo '<p class="msg">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>
    </form></div>
    
</body>
</html>