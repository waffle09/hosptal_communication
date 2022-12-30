<?php
	session_start();
	if(!$_SESSION['user']){
	header('Location:/registration/index2.php');
	}
	if($_SESSION['user']){
        $id = $_SESSION['user']['id'];
        $lastvisittime = time();
        $connect = mysqli_connect('localhost', 'root', '1235', 'hospital_users');
        mysqli_query($connect, "UPDATE `users` SET `lastvisittime` = '$lastvisittime' WHERE `users`.`id` = '$id'");
        }

if(isset($_POST['enter'])){
	if($_POST['name'] != ""){
		$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
	}
	else{
		echo '<span class="error">Please type in a name</span>';
	}
}
	$users = mysqli_query($connect, "SELECT `full_name`,`lastvisittime` FROM `users`");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chat</title>
<link type="text/css" rel="stylesheet" href="style4.css" />
<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/69/69495.png" type="image/x-icon">
<div id="header">
        <h1>Hospital | The system of hospital communication</h1>
        </div>
        <div class="menu">
                <a class="a_menu" href="../index.php">Новини</a>
                <a class="a_menu" href="../chat/index3.php">Чат</a>
                <a class="a_menu" href="../cards/index4.php">E-Карти</a>
                <a class="a_menu" href="\registration\index2.php">Профіль</a>
        </div>
</head>

<?php
if(!isset($_SESSION['user'])){
	// loginForm();
}
else{
?>
<div id="wrapper">
	<div id="menu">
		<p class="welcome">Ви увійшли до чату як користувач:  <b><?php echo $_SESSION['user']['full_name']; ?></b></p>
		<!-- <p class="logout"><a id="exit" href="#">Exit Chat</a></p> -->
		<div style="clear:both"></div>
	</div>	
	<div id="chatbox"><?php
	if(file_exists("log.html") && filesize("log.html") > 0){
		$handle = fopen("log.html", "r");
		$contents = fread($handle, filesize("log.html"));
		fclose($handle);
		
		echo $contents;
	}
	?></div>
	
	<form name="message" action="">
		<input name="usermsg" type="text" id="usermsg" size="63" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
		<input  style="background: lightcoral;" type="reset" id="submitmsg" value="Clear">
	</form>
</div>
<div id="userlist">
	<div id="userbox">
		<h3>All users:</h3>
	<?php
	while ($row = mysqli_fetch_array($users)) {
		// print("Город: " . $row['full_name'] . "; Идентификатор: . " . $row['lastvisittime'] . "<br>");
		print("<b>" . $row['full_name'] . "</b>");
		if($row['lastvisittime'] > (time()-30)){
			print('; <span style="color:green;"> online </span><br>');
			}
			else{
			print('<span style="color:grey;">; offline </span><br>');
			}
	}
	?></div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		$.ajax({
			url: "log.html",
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
	
	//If user wants to end session
	// $("#exit").click(function(){
	// 	var exit = confirm("Are you sure you want to end the session?");
	// 	if(exit==true){window.location = 'index.php?logout=true';}		
	// });
});
</script>
<?php
}
?>
</body>
</html>