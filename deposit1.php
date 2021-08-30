<?php
	$hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
	session_start();
	if ( $_SESSION['ssnid'] != 'sesSion5' ) {
	 header("location: l.php");
	}

 include_once("./sg_banking_init.php");

 if (isset($_GET['erros'])) {
    $erros=$_POST['erros'];
 } else {
    $errors = '';
 }


 if (isset($_POST['bank_account_cd'])) {
    $bank_account_cd=$_POST['bank_account_cd'];
 } else {
    $bank_account_cd=1051001;
 }

 $bank_cd = floor($bank_account_cd / 1000000);

 $deposit_cd = floor(($bank_account_cd % 1000000) / 100000);
 $company_cd=$bank_account_cd % 1000;

 if (isset($_POST['amount'])) {
    $amount=$_POST['amount'];
 } else {
    $amount=0;
 }

 if (isset($_POST['tk'])) {
    $tk=$_POST['tk'];
 } else {
    $tk=date("y/m/j H:i");
 }


	 function showAccount($accountcdf,&$c_ary){
  include_once("./sg_banking_init.php");
  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
   $db->exec('SET NAMES utf8');
   $sql = "SELECT bank_account_cd, company_cd FROM bank_account";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou=$stt->fetch(PDO::FETCH_ASSOC)) {
      $show_str=$gyou['bank_account_cd']." ".$c_ary[$gyou['company_cd']];

      print("<option value='".$gyou['bank_account_cd']."' ".("'".$accountcdf."'" == "'".$gyou['bank_account_cd']."'"?" selected ":"")." >".$show_str."</option>\n");
   }
   $gyou=$stt->fetch(PDO::FETCH_ASSOC);
   $db = NULL;
  } catch(PDOException $e) {
   die('showbu関数内でMySQL接続失敗' . $e->getMessage());
  }
 }

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>総合実践 普通預金口座入金ページ</title>
</head>
<body bgcolor="#0099FF">
<center>
<h3 align="center">総合実践 普通預金口座入金</h3>

<?php
  if ($errors != '') echo $errors."<br>\n";
?>

<form name="form1" method="post" action="./deposit2.php">
    <input type="hidden" name="tk" value="<?= date("y/m/j H:i") ?>">    <input type="hidden" name="deposit_cd" value="1">
	<div align="center">
	<table border="1">
	<tr align="center" valign="middle">
	 <td bgcolor="#CCCCCC">口座番号</td>
	 <td bgcolor="#FF9933">
		<select name="bank_account_cd" colspan="6"><br>
<?php (showAccount($bank_account_cd,$company_ary)); ?>
</select>	
    </td>
	</tr>
	<tr align="center" valign="middle">
	 <td bgcolor="#99ff99">銀行区分<br>(1:宇和島支店 2:大阪支店)</td>
	 <td align="center"><input name="bank_cd" type="text" size="6" value="<?= floor($bank_account_cd / 1000000) ?>"></td>
	</tr>
	<tr align="center" valign="middle">
	 <td bgcolor="#0000FF"><font color="#66FF99">入金企業コード</font></td>
	 <td align="center"><input name="company_cd" type="text" size="6" value="<?=$bank_account_cd % 1000 ?>"></td>
    </tr>
	<tr align="center" valign="middle">
	 <td bgcolor="#FFFF66">入金金額</td>
	 <td align="center"><input name="amount" type="text" size="6" value="<?php echo $amount; ?>"></td>
	</tr>
	</table>
	<br>
    <h6><?php print("登録時刻：".$tk." (UTC)<br>\n"); ?><h6>
	<input type="submit" value="入金実行">
	</div>
</form>
<a href="<?=$hosturl?>/~ubuntu/sg_banking/menu.php">目次</a>&nbsp;&nbsp;<a href="<?=$hosturl?>/~ubuntu/sg_banking/deposit1.php">再表示</a><br>
</center>
</body></html>
