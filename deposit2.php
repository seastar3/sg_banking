<?php
	$hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
	session_start();
	if ( $_SESSION['ssnid'] != 'sesSion5' ) {
	 header("location: l.php");
	}

  include_once("./sg_banking_init.php");

 // エラー内容
 $errors = [];

 if (isset($_POST['bank_account_cd'])) {
    $bank_account_cd=$_POST['bank_account_cd'];
    $bank_cd = floor($bank_account_cd / 1000000);
    $deposit_cd = floor(($bank_account_cd % 1000000) / 100000);
    $company_cd=$bank_account_cd % 1000;
 } else {
    $errors[] = '預金口座コードセットエラー';
 }

 if (!isset($_POST['bank_cd']) || $_POST['bank_cd'] != $bank_cd) {
    $errors[] = '銀行コードエラー';
 }

 if (!isset($_POST['deposit_cd']) || $_POST['deposit_cd'] != $deposit_cd) {
    $errors[] = '預金種別エラー';
 }

 if (!isset($_POST['company_cd']) || $_POST['company_cd'] != $company_cd) {
    $errors[] = '入金企業コードエラー';
 }

 if (isset($_POST['amount']) && $_POST['amount'] > 0) {
    $amount=$_POST['amount'];
    $fee = 0;
 } else {
    $errors[] = '入金金額エラー';
 }

 if (isset($_POST['tk'])) {
    $tk=$_POST['tk'];
 } else {
    $errors[] = '日時データエラー';
 }

//  header("Location: menu.php");

  if (!empty($errors)){
	$errors_str="";
    foreach ($errors as &$msg) {
      $errors_str .= $msg.",";
    }
//    $r_url= "Location: <?=$hosturl?>/~ubuntu/sg_banking/deposit1.php";
    $r_url = 'deposit1.php&errors='.urlencode($errors_str);
echo $r_url."<br>\n";
//    header('Location: '.$r_url);
  }

  }
  }

// banking_transaction の各フィールド
// transaction_cd transaction_timestamp job_cd applicant_company_cd
// my_account_cd other_account_cd amount fee	completion_flg comment
// transaction_hash_value

// クエリ結果操作	
  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
   $db->exec('SET NAMES utf8');
   $sql = "INSERT INTO banking_transaction VALUES ( 0,"."cast('".$tk."' AS datetime),1,".$bank_cd.",".$company_cd.",0,".$amount.",0,true,'ok','Here will be hash value.')";
   $stt = $db->prepare($sql);
   $stt->execute();

   $sql = "SELECT LAST_INSERT_ID() AS last_id;";
   $stt = $db->prepare($sql);
   $stt->execute();
   $gyou=$stt->fetch(PDO::FETCH_ASSOC);
   $last_id = $gyou['last_id'];
//   flush();

   $sql = "SELECT * FROM banking_transaction WHERE transaction_cd = ".$last_id;
   $stt = $db->prepare($sql);
   $stt->execute();
   $gyou=$stt->fetch(PDO::FETCH_ASSOC);
   $bun="#";
   foreach($gyou AS &$value){
     $bun .= $value;
   }
   $bun .= "#";
   $tran_hash = hash('md5',$bun,false);

   $sql = "UPDATE banking_transaction SET transaction_hash_value = '".$tran_hash."' WHERE transaction_cd = ".$last_id;
   $stt = $db->prepare($sql);
   $stt->execute();

   $sql = "UPDATE bank_account SET amount = amount +'".$amount."' WHERE bank_account_cd = ".$bank_account_cd;
   $stt = $db->prepare($sql);
   $stt->execute();

    $gyou = null;
    $stt = null;
  } catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
  header("Location: menu.php");
?>
