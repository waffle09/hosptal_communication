<?
session_start();
if(isset($_SESSION['user'])){
	$id = $_SESSION['user']['id'];
	$text = $_POST['text'];
	$log = "log" . $id . ".html";
	$fp = fopen($log, 'a');
	fwrite($fp, "<div class='msgln'>".stripslashes(htmlspecialchars($text))."<br></div>");
	fclose($fp);
	exit("<meta http-equiv='refresh' content='0; url=profile.php'>");
}
?>