<?php
	$hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
	session_start();
	if ($_SESSION['ssnid'] == 'sesSion5') {
		$_SESSION = array();
		unset($_SESSION['ssnid']);
		session_destroy();
//		header('HTTP/1.1 301 Moved Permanently');
//		header("location: h.php");
		print("<br><br><h1 align=\"center\"><a href=\"" . $hosturl . "/~ubuntu/sg_banking/menu.php\">総合実践バンキングシステムメニューへ移動</a></h1><br>");
	} else {
		header("location: l.php");
	}
?>
