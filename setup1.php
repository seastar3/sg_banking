<?php
  $hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
  session_start();
  if ( $_SESSION['ssnid'] != 'sesSion5' ) {
    header("location: l.php");
  }

  try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
    $db->exec('SET NAMES utf8');
    $sql = "UPDATE bank_account SET amount = 1000000 WHERE MOD(company_cd,100) < 50";
    $pdoblock = $db->prepare($sql);
    $pdoblock->execute();

    $sql = "UPDATE bank_account SET amount = 2000000 WHERE MOD(company_cd,100) > 51";
    $pdoblock = $db->prepare($sql);
    $pdoblock->execute();

    $sql = "UPDATE bank_account SET amount = 50000000 WHERE MOD(company_cd,100) = 51";
    $pdoblock = $db->prepare($sql);
    $pdoblock->execute();

   } catch(PDOException $e) {
      die('MySQL接続失敗' . $e->getMessage());
   }
   header('Location: menu.php');
//   header('Location: '.$hosturl.'/~ubuntu/sg_banking/menu.php');

?>
