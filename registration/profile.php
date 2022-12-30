<?php
    session_start();
    require_once 'connect.php';
    $id = $_SESSION['user']['id'];

    if(!$_SESSION['user']){
        header('Location: index2.php');
    } 
    if($_SESSION['user']){
        // $lastvisittime = time();
        mysqli_query($connect, "UPDATE `users` SET `lastvisittime` = '$lastvisittime' WHERE `users`.`id` = '$id'");
        }

    $num_rows = mysqli_query($connect, "SELECT `lastvisittime` FROM `users` WHERE `id`= 2");
    $user = mysqli_fetch_assoc($num_rows);
    $lastvisittime = $user['lastvisittime'];
    if($lastvisittime < (time())){
        $_SESSION['status2'] = 'online';
    }
    else{
        $_SESSION['status2'] = 'offline';
    }
    $d = strtotime("+1 day");
    $to_date = date("Y-m-d");

    mysqli_query($connect, "DELETE FROM `clients` WHERE `to_date`< (NOW() - INTERVAL 1 DAY)");
    $clients = mysqli_query($connect, "SELECT `to_date`,`doctor_id`,`client_name` FROM `clients`");
    $log = "log" . $id . ".html"; 
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=Au">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/69/69495.png" type="image/x-icon">
    <link href="../chat/style4.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
<div class="header">
        <h1>Hospital | The system of hospital communication</h1>
        </div>
        <div class="menu" style="margin-bottom:20px;">
                <a class="a_menu" href="../index.php">Новини</a>
                <a class="a_menu" href="../chat/index3.php">Чат</a>
                <a class="a_menu" href="../cards/index4.php">E-Карти</a>
                <a class="a_menu" href="\registration\index2.php">Профіль</a>
        </div>
    <!-- Registration form -->
    <div style="display:flex; flex-direction:row;">
    <div style="display:flex; flex-direction:column;">
    <div class="frame" style="padding-right: 0%; padding-top: 0px;">
        <div class = "prof" style="margin-top:0;">
            <h2><?= $_SESSION['user']['full_name'] ?></h2>
            <?php
            echo '<p style="color:gray;">' . $_SESSION['status2'] . '</p><br>';
            ?>
            <p>Посада: <?= $_SESSION['user']['status'] ?></p>
            <p style="margin-bottom: 15px;">Пошта: <a href ="#"><?= $_SESSION['user']['email'] ?></a></p><br>
            <a style="background: mediumaquamarine; padding: 10px; text-align: center; color: black; text-decoration:none;" href="logout.php" class="logot">Вихід</a>
        </div>
     </div>
     <div class = "prof" style="border: 3px solid white; padding-top:0px; padding-right:0;;">
     <iframe src="https://calendar.google.com/calendar/embed?src=ru.ukrainian%23holiday%40group.v.calendar.google.com&ctz=UTC" style="border: 0" width="400" height="300" frameborder="0" scrolling="no"></iframe> 
    </div></div>
     <div id="wrapper" style="width:40%; margin-top:20x; height: 555px;">
	<div id="menu">
		<div style="clear:both"></div>
	</div>	
	<div id="chatbox" style="height: 430px;"><?php
	if(file_exists($log) && filesize($log) > 0){
		$handle = fopen($log, "r");
		$contents = fread($handle, filesize($log));
		fclose($handle);
		
		echo $contents;
	}
	?></div>
	
	<form name="message2" action="">
		<input style="width:400px;" name="usermsg" type="text" id="usermsg" size="63"  onclick="header('Refresh:5');">
		<input style="width:50px;" name="submitmsg" type="submit"  id="submitmsg" value="Save">
		<!-- <input  style="width:50px; background: lightcoral;" type="reset" id="submitmsg" value="Clear"> -->
        <input  style="width:50px; background: lightcoral; margin: 10px 0;
    padding: 10px;
    border: unset;
    border-bottom: 2px solid #e3e3e3;
    outline: none;" type="submit" id="exit" value="Clear">
	</form>
</div>
    <div class="prof" style="border:3px solid mediumaquamarine; float:right; margin-right:20px; height: 500px; overflow:auto;">
            <h2 style="text-align:center;">Клієнти за записом</h2>
            <?php
        $i=0;
        // $dates = [];
        $clien =[];
	while ($clients2 = mysqli_fetch_array($clients)) {
        if( $clients2['doctor_id'] === $_SESSION['user']['id']){
            // $dates[$i] = $clients2['to_date'];
            $clien[$i] = [
                "to_date"=>$clients2['to_date'],
                "client_name"=>$clients2['client_name']
            ];
        }
        $i++;
    }
    print('<h3>Сьогодні</h3>');
    // for($k=0; $k < count($clien);$k++){
        for($k = count($clien)-1;$k>=0;$k--){
            // for($m=0; $m < count($dates2); $m++){
                if($clien[$k]['to_date'] === $to_date){
                    print('<p>' . $clien[$k]['client_name'] . "</p>");
                }
            }
    print('<h3>Завтра</h3>');
    // for($k=0; $k < count($clien);$k++){
        for($k = count($clien)-1;$k>=0;$k--){
        // for($m=0; $m < count($dates2); $m++){
            if($clien[$k]['to_date'] === date("Y-m-d",$d)){
                print('<p>' . $clien[$k]['client_name'] . "</p>"); 
            }
        }
        print('<h3>Інші дати</h3>');
        for($k=0; $k < count($clien);$k++){
            // for($k = count($clien)-1;$k>=0;$k--){
                // for($m=0; $m < count($dates2); $m++){
                    if($clien[$k]['to_date'] > date("Y-m-d",$d)){
                        print('<p><b>' . $clien[$k]['to_date'] . "</b>: " . $clien[$k]['client_name'] . '</p>'); 
                    }
                }
    
            ?>
        </div></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("notes.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
        // window.location = 'profile.php';
        // document.location.reload();
        // location.href='profile.php';
		return false;
	});
	
    //If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Справді хочете видалити всі нотатки?");
		if(exit==true){
            var clientmsg = "";
		    $.post("deletenote.php", {text: clientmsg});
		    return false;
            // <!-- <?php
            // exit("<meta http-equiv='refresh' content='0; url=profile.php'>"); 
            ?> -->
        }		
	});
	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		$.ajax({
			// url: "log6.html",
            url: $log,
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
        
	}
	setInterval (loadLog, 2500);	//Reload file every 2.5 seconds
});
</script>
</body>
</html>