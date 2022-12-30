<?php
    session_start();
    // require_once '/registration/connect.php';
    $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');
    if($_SESSION['user']){
        $id = $_SESSION['user']['id'];
        $lastvisittime = time();
        mysqli_query($connect, "UPDATE `users` SET `lastvisittime` = '$lastvisittime' WHERE `users`.`id` = '$id'");
        }
    $users = mysqli_query($connect, "SELECT `card_id`,`ful_clent_name`,`date_of_birth`,`adress`,`email`,`phone`,`status`,`doctor_id`,`history` FROM `cards`");
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Cards</title>
    <link href="../styyle.css" rel="stylesheet">
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
                <a class="a_menu" href="../index.php">Новини</a>
                <?php
                if($_SESSION['user']){
                echo '<a class="a_menu" href="\chat\index3.php">Чат</a>';
                echo '<a class="a_menu" href="/cards/index4.php">E-Карти</a>';
                }
                ?>
                <a class="a_menu" href="\registration\index2.php">Профіль</a>
        </div>
        <div class="news">
            <h2 style="text-align:center;">Карти хворих</h2>
            <form method="get" style="displey:flex; flex-direction:row;">
<input name="time" type="text" size="60" style="margin-left:150px;" placeholder="Введіть сюди інформацію про карту яку бажаєте знайти">
<input type="submit" value="Знайти" style="width:120px; background: mediumaquamarine;">
</form>

            <?php
            $value = $_GET['time'];

            $i=0;
	while ($cl = mysqli_fetch_array($users)) {
        $row[$i] = [
            "card_id"=>$cl['card_id'],
            "ful_clent_name"=>$cl['ful_clent_name'],
            "date_of_birth"=>$cl['date_of_birth'],
            "adress"=>$cl['adress'],
            "email"=>$cl['email'],
            "phone"=>$cl['phone'],
            "status"=>$cl['status'],
            "doctor_id"=>$cl['doctor_id'],
            "history"=>$cl['history']
        ];
        $i++;
    }
    $finded = 0;
    $id = 0;
    $hst = 0;
        for($n = 0; $n < count($row); $n++){
            if($value === $row[$n]['card_id']){
            $finded=$finded+1;
            $id = $row[$n]['card_id'];
        }
            elseif($value === $row[$n]['ful_clent_name']){
                $finded=$finded+1;
            }
            elseif($value === $row[$n]['date_of_birth']){
                $finded=$finded+1;
            }
        }
        print('<p>Всього за вашим запитом знайдено результатів: ' . $finded . '</p>');
    // $finded = 0;
    $arr=[];
        for($n = 0; $n < count($row); $n++){
            if($value === $row[$n]['card_id']){
            print('<div class="news3"><p>'. $row[$n]['card_id'] . '. <h3 style="padding-left:30px;">' . $row[$n]['ful_clent_name'] . "</h3></p>");
            print('<h5>('. $row[$n]['date_of_birth'] . ')</h5>');
            print('<p> Місце проживання: '. $row[$n]['adress'] . "</p>");
            print('<p> Посада: ' . $row[$n]['status'] . "</p>");
            print('<p> Телефон: ' . $row[$n]['phone'] . ', E-mail: <a href="#">'. $row[$n]['email'] .'</a></p>');
            print('<p><b> Історія хвороби:</b> <br>' . $row[$n]['history'] .'</p>');
            // print("<p><br><a style='width:200px; margin-right: 10px; background: mediumaquamarine; padding: 10px; text-decoration: none; color:black;' href='ad_history.php?id=$id'>Відкрити</a></p></div>");
            echo "<form action='ad_history.php?id=$id' method='post'>";
            echo '<label><b>Додати до істрорії хвороби:</b></label>';
            echo '<textarea type = "text" name = "history2" required placeholder = "Тут можете писати свій текст"></textarea>';
            // echo '<!-- <button type="submit">Send</button> -->';
            echo '<div style="display:flex;flex-direction:row;">';
            echo '<input type="submit" id="submitmsg" value="Add">';
		    echo '<input style="background: lightcoral; margin-left:140px;" type="reset" id="submitmsg" value="Clear"></div></form></div>';
        }
            elseif($value === $row[$n]['ful_clent_name']){
                print('<div class="news3"><p>'. $row[$n]['card_id'] . '. <h3 style="padding-left:30px;">' . $row[$n]['ful_clent_name'] . "</h3></p>");
                print('<h5>('. $row[$n]['date_of_birth'] . ')</h5>');
                print('<p> Місце проживання: '. $row[$n]['adress'] . "</p>");
                print('<p> Посада: ' . $row[$n]['status'] . "</p>");
                print('<p> Телефон: ' . $row[$n]['phone'] . ', E-mail: <a href="#">'. $row[$n]['email'] .'</a></p></div>');
                // print('<p> Історія хвороби: <br>' . $row[$n]['history'] .'</p></div>');
                // print("<p><br><a style='width:200px; margin-right: 10px; background: mediumaquamarine; padding: 10px; text-decoration: none; color:black;' href='ad_history.php?id=$id,hst=$hst,arr[$n]=$row[$n]'>Відкрити</a></p></div>");
                
            }
            elseif($value === $row[$n]['date_of_birth']){
                print('<div class="news3"><p>'. $row[$n]['card_id'] . '. <h3 style="padding-left:30px;">' . $row[$n]['ful_clent_name'] . "</h3></p>");
                print('<h5>('. $row[$n]['date_of_birth'] . ')</h5>');
                print('<p> Місце проживання: '. $row[$n]['adress'] . "</p>");
                print('<p> Посада: ' . $row[$n]['status'] . "</p>");
                print('<p> Телефон: ' . $row[$n]['phone'] . ', E-mail: <a href="#">'. $row[$n]['email'] .'</a></p></div>');
                // print('<p> Історія хвороби: <br>' . $row[$n]['history'] .'</p></div>');
            }
        }
        // if($finded != 0){
            // echo "<form action='ad_history.php?id=$id,hst=$hst' method='post'>";
            // echo '<label>Додати до істрорії хвороби:</label>';
            // echo '<textarea type = "text" name = "history2" required placeholder = "Тут можете писати свій текст"></textarea>';
            // // echo '<!-- <button type="submit">Send</button> -->';
            // echo '<div style="display:flex;flex-direction:row;">';
            // echo '<input type="submit" id="submitmsg" value="Add">';
		    // echo '<input style="background: lightcoral; margin-left:140px;" type="reset" id="submitmsg" value="Clear"></div></form></div>'; 
        // }
        
            ?>
            </div>
        <div class="news2" style="height: 500px; overflow:auto;">
        <form method="post" style="displey:flex; flex-direction:row;">
            <input type="submit" name="all_cl" value="Всі клієнти" style="width:200px; margin-right: 10px; background: mediumaquamarine;"></input>
            <input type="submit" name="your_cl" value="Ваші клієнти" style="width:200px; margin-left: 30px; background: mediumaquamarine;"></input></form>
            <h2 style="text-align:center;">Клієнтська база</h2>
            <p>(id карти (дата народження)). (повне ім'я хворого)</p>
            <?php
            // print('<button type="submit" name="your_cl">Ваші клієнти</button>');
            if(isset($_POST['all_cl'])){
            for($n = 0; $n < count($row); $n++){
                        print('<p>'. $row[$n]['card_id'] . ' ('. $row[$n]['date_of_birth'] . '). <b>' . $row[$n]['ful_clent_name'] . "</b></p>");
                    }
                }
            else{
                for($n = 0; $n < count($row); $n++){
                    if($row[$n]['doctor_id'] === $_SESSION['user']['id']){
                    print('<p>'. $row[$n]['card_id'] . ' ('. $row[$n]['date_of_birth'] . '). <b>' . $row[$n]['ful_clent_name'] . "</b></p>");}
                }
            }
        ?>
            </div>
</body>
</html>