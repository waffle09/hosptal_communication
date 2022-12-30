<?php
    session_start();
    // require_once '/registration/connect.php';
    $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');
    if($_SESSION['user']){
        $id = $_SESSION['user']['id'];
        $lastvisittime = time();
        mysqli_query($connect, "UPDATE `users` SET `lastvisittime` = '$lastvisittime' WHERE `users`.`id` = '$id'");
        }
    $users = mysqli_query($connect, "SELECT `ntitle`,`ntext`,`author`,`ndate` FROM `news`");
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link href="styyle.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/69/69495.png" type="image/x-icon">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <h1>Hospital | The system of hospital communication</h1>
        </div>
        <div class="menu">
                <a class="a_menu" href="index.php">Новини</a>
                <?php
                if($_SESSION['user']){
                echo '<a class="a_menu" href="\chat\index3.php">Чат</a>';
                echo '<a class="a_menu" href="/cards/index4.php">E-Карти</a>';
                }
                ?>
                <a class="a_menu" href="\registration\index2.php">Профіль</a>
        </div>
        <div class="news">
            <h2 style="text-align:center;">Актуальні новини сайту</h2>
            <?php
            $i=0;
	while ($clients2 = mysqli_fetch_array($users)) {
        $row[$i] = [
            "ntitle"=>$clients2['ntitle'],
            "ntext"=>$clients2['ntext'],
            "author"=>$clients2['author'],
            "ndate"=>$clients2['ndate']
        ];
        $i++;
        // print('<div class="news3"><h3 style="padding-left:30px;">' . $row['ntitle'] . '</h3>');
        // print('<p>' . $row['ntext'] . "</p>");
        // print('<p style="color:gray;">' . $row['author'] . '; ' . $row['ndate'] . '</div>');
    }
    for($y = count($row)-1;$y>=0;$y--){
        print('<div class="news3"><h3 style="padding-left:30px;">' . $row[$y]['ntitle'] . '</h3>');
        print('<p>' . $row[$y]['ntext'] . "</p>");
        print('<p style="color:gray;">' . $row[$y]['author'] . '; ' . $row[$y]['ndate'] . '</p></div>');

    }
            ?>
            </div>
        <div class="news2">
            <h2 style="text-align:center;">Додати новину</h2>
            <?php
            if($_SESSION['user']){
            echo '<form action="addnews.php" method="post">';
            echo '<label>Заголовок</label>';
            echo '<input type = "text" name = "ntitle" required placeholder = "Створіть заголовок для вошої новини">';
            echo '<label>Текст</label>';
            echo '<textarea type = "text" name = "ntext" required placeholder = "Тут можете писати свій текст"></textarea>';
            echo '<!-- <button type="submit">Send</button> -->';
            echo '<div style="display:flex;flex-direction:row;">';
            echo '<input type="submit" id="submitmsg" value="Send">';
		    echo '<input style="background: lightcoral; margin-left:140px;" type="reset" id="submitmsg" value="Clear"></div></form>';
            }
            else{
                echo '<p class="msg">Для того, щоб додавати новини будь-ласка <a style="text-decoration:none;color:gray;" href="\registration\index2.php">авторизуйтеся</a></p>';
            }
        ?>
        <?php
            if($_SESSION['message2']){
                echo '<p class="msg">' . $_SESSION['message2'] . '</p>';
            }
            unset($_SESSION['message2']);
        ?>
            </div>
</body>
</html>