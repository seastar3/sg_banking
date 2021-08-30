<?php
  $hosturl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];

 include_once("./sg_banking_init.php");

?>

<html>
<meta htrp-equiv="Content-Type" content="text/html; charset=shift_jis">
<meta htrp-equiv="refresh" content="600">
<title>テスト表示</title>
<?php
function f1($v,&$ary){
	return $ary[$v];
}
?>
</head>
<body bgcolor="#33FF33">
<center>
<br>テスト表示<br>
<?php
  $key='152';
  echo f1($key,$company_ary);
?>
</body></html>
