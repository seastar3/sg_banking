<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Language" content="ja" />
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
 <title>総合実践バンキングシステムメニュー</title>
 <?php $hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];?>
</head>
<body bgcolor="#ffccff">
<h3>総合実践バンキングシステムメニュー</h3>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/l.php">１　認証ログイン操作</a> <br>
<br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/lout.php">２　ログアウト操作</a> <br>
<br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/setup1.php">３　銀行取引先登録バッチ処理</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/deposit1.php">４　入金処理</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/withdraw1.php">５　出金処理</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/sendmaney1.php">６　送金処理</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/cryptocurrency_task1.php">７　暗号資産処理</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/account_amount_listup.php">８　総合実践登録銀行口座一覧表示</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/.php">９　企業別取引ログ表示</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/.php">10　口座別取引ログ表示</a> <br><br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/.php">11　取引整合性診断(各レコードのハッシュ値の検査</a> <br>)<br>
　<a href="<?php print $hosturl ?>/~ubuntu/sg_banking/masters_listup.php">12　マスタデータ一覧表示（企業、銀行口座、預金種別、銀行業務）</a> <br><br>
 <br><br>
</body>
</html>
