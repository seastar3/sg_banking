<?php
  $hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
  session_start();
  if ( $_SESSION['ssnid'] != 'sesSion5' ) {
    header("location: l.php");
  }

  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
     $db->exec('SET NAMES utf8');
   } catch(PDOException $e) {
      die('MySQL接続失敗' . $e->getMessage());
   }
?>
<html>
<meta htrp-equiv="Content-Type" content="text/html; charset=shift_jis">
<meta htrp-equiv="refresh" content="600">
<title>総合実践マスタデータ一覧表示</title>
</head>
<body bgcolor="#33FF33">
<center>
<br>企業マスタデータ一覧表示<br>
 <table border="1">
  <tr align="center" valign="middle">
   <td bgcolor="#FF9933">企業コード</td>
   <td bgcolor="#CCCCCC">市場区分</td>
   <td bgcolor="#FF9933">企業名</td>
  </tr>
<?php
  try {
    $sql = "SELECT * FROM company_master";
    $stt = $db->prepare($sql);
    $stt->execute();
    while($gyou=$stt->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr align='center' valign='middle'>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['company_cd']."</td>\n";
	  echo "<td align='center' bgcolor='#eeeeee'>".$gyou['market_cd']."</td></td>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['company_name']."</td></td>\n";
	  echo "</tr>\n";
	}
    $gyou=$stt->fetch(PDO::FETCH_ASSOC);
    $db = NULL;
  } catch(PDOException $e) {
    die('MySQL接続失敗' . $e->getMessage());
  }
  echo "</table>";
?>

<br>銀行口座マスタデータ一覧表示<br>
 <table border="1">
  <tr align="center" valign="middle">
   <td bgcolor="#FF9933">口座番号</td>
   <td bgcolor="#CCCCCC">銀行コード</td>
   <td bgcolor="#FF9933">預金区分</td>
   <td bgcolor="#CCCCCC">企業コード</td>
   <td bgcolor="#FF9933">残高金額</td>
  </tr>
<?php
  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
     $db->exec('SET NAMES utf8');
    $sql = "SELECT * FROM bank_account";
    $stt = $db->prepare($sql);
    $stt->execute();
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

<br>預金種別マスタデータ一覧表示<br>
 <table border="1">
  <tr align="center" valign="middle">
   <td bgcolor="#FF9933">預金種別区分</td>
   <td bgcolor="#CCCCCC">通貨コード</td>
   <td bgcolor="#FF9933">預金種別</td>
  </tr>
<?php
  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
     $db->exec('SET NAMES utf8');
    $sql = "SELECT * FROM deposit_master";
    $stt = $db->prepare($sql);
    $stt->execute();
    while($gyou=$stt->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr align='center' valign='middle'>\n";
	  echo "<td bgcolor='#CCCCCC'>".$gyou['deposit_cd']."</td>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['currency_cd']."</td>\n";
	  echo "<td bgcolor='#CCCCCC'>".$gyou['deposit_name']."</td>\n";
	  echo "</tr>\n";
	}
    $gyou=$stt->fetch(PDO::FETCH_ASSOC);
    $db = NULL;
  } catch(PDOException $e) {
    die('MySQL接続失敗' . $e->getMessage());
  }
  echo "</table>";
?>
通貨コードは 1:円 2:dollar 3:euro 4:元 9:Etherium<br><br>

<br>銀行業務マスタデータ一覧表示<br>
 <table border="1">
  <tr align="center" valign="middle">
   <td bgcolor="#FF9933">銀行業務コード</td>
   <td bgcolor="#CCCCCC">銀行業務</td>
  </tr>
<?php
  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
     $db->exec('SET NAMES utf8');
    $sql = "SELECT * FROM job_master";
    $stt = $db->prepare($sql);
    $stt->execute();
    while($gyou=$stt->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr align='center' valign='middle'>\n";
	  echo "<td bgcolor='#CCCCCC'>".$gyou['job_cd']."</td>\n";
	  echo "<td bgcolor='#FFFF66'>".$gyou['job_name']."</td>\n";
	  echo "</tr>\n";
	}
    $gyou=$stt->fetch(PDO::FETCH_ASSOC);
    $db = NULL;
  } catch(PDOException $e) {
    die('MySQL接続失敗' . $e->getMessage());
  }
  echo "</table>";
?>

<br><br>
<a href="<?=$hosturl?>/~ubuntu/sg_banking/menu.php">目次</a><br>
</center>
</body></html>
