<?php
  $hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
  session_start();
  if ( $_SESSION['ssnid'] != 'sesSion5' ) {
    header("location: l.php");
  }

  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
     $db->exec('SET NAMES utf8');
     $sql = "SELECT * FROM bank_account";
     $stt = $db->prepare($sql);
     $stt->execute();
   } catch(PDOException $e) {
      die('MySQL接続失敗' . $e->getMessage());
   }
?>
<html>
<meta htrp-equiv="Content-Type" content="text/html; charset=shift_jis">
<meta htrp-equiv="refresh" content="600">
<title>総合実践登録銀行口座一覧</title>
</head>
<body bgcolor="#33FF33">
<center>
<br>総合実践登録銀行口座一覧<br><br>
 <table border="1">
  <tr align="center" valign="middle">
   <td bgcolor="#FF9933">口座ID</td>
   <td bgcolor="#CCCCCC">銀行cd</td>
   <td bgcolor="#FF9933">預金cd</td>
   <td bgcolor="#CCCCCC">企業cd</td>
   <td bgcolor="#FF9933">残高金額</td>
  </tr>

<?php
  try {
    $sql = "SELECT * FROM bank_account";
    while($gyou=$stt->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr align='center' valign='middle'>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['bank_account_cd']."</td>\n";
	  echo "<td align='center' bgcolor='#eeeeee'>".$gyou['bank_cd']."</td></td>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['deposit_cd']."</td></td>\n";
	  echo "<td align='center' bgcolor='#eeeeee'>".$gyou['company_cd']."</td></td>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['amount']."</td></td>\n";
	  echo "</tr>\n";
	}
    $gyou=$stt->fetch(PDO::FETCH_ASSOC);
    $db = NULL;
  } catch(PDOException $e) {
    die('MySQL接続失敗' . $e->getMessage());
  }
  echo "</table>";
?>

<h6><?php $tk=date("y/m/j H:i"); print("登録時刻：".$tk." (UTC)<br>\n"); ?><h6>

<a href="<?=$hosturl?>/~ubuntu/t2/menu.php">目次</a>&nbsp;&nbsp;<a href="<?=$hosturl?>/~ubuntu/t2/h.php">更新</a><br>
</center>
</body></html>
