
<?php
// 総合実践バンキングシステム初期値セット  sg_banking_init.php
// 通貨種別の連想配列用意と、企業マスタテーブル、通貨種別マスタテーブル、銀行業務区分マスタテーブルからの連想配列を準備する処理。各処理で最初にインクルードする。

// 通貨種別の連想配列用意
// 通貨コードは 1:円 2:dollar 3:euro 4:元 9:Etherium
 $currency_ary['0']  = '';
 $currency_ary['1'] = '円';
 $currency_ary['2'] = 'dollar';
 $currency_ary['3']  = 'euro';
 $currency_ary['4']  = '元';
 $currency_ary['9']  = 'Etherium';

 try {
    $db = new PDO('mysql:host=localhost;dbname=sg_banking', 'user', '10Ttokuten');
   $db->exec('SET NAMES utf8');

// 企業マスタテーブルのフェッチ
   $sql = "SELECT * FROM company_master";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou= $stt->fetch(PDO::FETCH_ASSOC)){
     $company_cd=$gyou['company_cd'];
     $company_name=$gyou['company_name'];
     $company_ary[$company_cd] = $company_name;
   }

// 企業マスタテーブルのフェッチ
   $sql = "SELECT * FROM company_master";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou= $stt->fetch(PDO::FETCH_ASSOC)){
     $company_cd=$gyou['company_cd'];
     $company_name=$gyou['company_name'];
     $company_ary[$company_cd] = $company_name;
   }

// 銀行マスタテーブルのフェッチ
// bank_aryの銀行の添字は1:宇和島市場で151(宇和島支店の企業コード)、
//     2:大阪市場で252(大阪支店の企業コード)を記録する。
   $sql = "SELECT * FROM bank_master";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou= $stt->fetch(PDO::FETCH_ASSOC)){
     $bank_cd=$gyou['bank_cd'];
     $market_cd=$gyou['market_cd'];
     $bank_ary[$market_cd] = $bank_cd;
   }

// 通貨種別マスタテーブルのフェッチ
   $sql = "SELECT * FROM deposit_master";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou= $stt->fetch(PDO::FETCH_ASSOC)){
     $deposit_cd=$gyou['deposit_cd'];
     $deposit_name=$gyou['deposit_name'];
     $deposit_ary[$deposit_cd] = $deposit_name;
   }

// 銀行業務区分マスタテーブルのフェッチ
   $sql = "SELECT * FROM job_master";
   $stt = $db->prepare($sql);
   $stt->execute();
   while($gyou= $stt->fetch(PDO::FETCH_ASSOC)){
     $job_cd=$gyou['job_cd'];
     $job_name=$gyou['job_name'];
     $job_ary[$job_cd] = $job_name;
   }

   $db = NULL;
 } catch(PDOException $e) {
   die('MySQL接続失敗' . $e->getMessage());
 }
?>
