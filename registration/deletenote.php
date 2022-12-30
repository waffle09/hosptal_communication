<?
session_start();
if(isset($_SESSION['user'])){
	$id = $_SESSION['user']['id'];
	$text = $_POST['text'];
	$log = "log" . $id . ".html";
	$fp = fopen($log, 'w');
	fwrite($fp, stripslashes(htmlspecialchars($text)));
	fclose($fp);
    // exit("<meta http-equiv='refresh' content='0; url=profile.php'>");
}
?>