-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 8 月 25 日 09:34
-- サーバのバージョン： 5.7.28-0ubuntu0.18.04.4
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `sg_banking`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `banking_transaction`
--

CREATE TABLE `banking_transaction` (
  `transaction_cd` int(11) NOT NULL,
  `transaction_timestamp` datetime NOT NULL,
  `job_cd` tinyint(4) NOT NULL,
  `applicant_company_cd` int(11) NOT NULL,
  `my_account_cd` int(11) NOT NULL,
  `other_account_cd` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `completion_flg` tinyint(1) NOT NULL,
  `comment` int(11) NOT NULL,
  `transaction_hash_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_account_cd` int(11) NOT NULL,
  `bank_cd` int(11) NOT NULL,
  `deposit_cd` tinyint(4) NOT NULL,
  `company_cd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `bank_master`
--

CREATE TABLE `bank_master` (
  `bank_cd` int(11) NOT NULL,
  `market_cd` smallint(6) NOT NULL,
  `bank_name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `bank_master`
--

INSERT INTO `bank_master` (`bank_cd`, `market_cd`, `bank_name`) VALUES
(151, 1, '（株）東洋銀行宇和島支店'),
(251, 2, '（株）東洋銀行大阪支店');

-- --------------------------------------------------------

--
-- テーブルの構造 `company_master`
--

CREATE TABLE `company_master` (
  `company_cd` int(11) NOT NULL,
  `market_cd` tinyint(4) NOT NULL,
  `market_name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `company_master`
--

INSERT INTO `company_master` (`company_cd`, `market_cd`, `market_name`) VALUES
(101, 1, '（株）朝日商事'),
(102, 1, '（株）恵美須商事'),
(103, 1, '（株）栄商事'),
(104, 1, '（株）丸之内商事'),
(105, 1, '（株）和霊商事'),
(151, 1, '（株）東洋銀行宇和島支店'),
(152, 1, '（株）明倫海上保険'),
(153, 1, '（株）築地倉庫'),
(154, 1, '（株）伊吹運送'),
(201, 2, '（株）茨木商事'),
(202, 2, '（株）貝塚商事'),
(203, 2, '（株）柏原商事'),
(204, 2, '（株）門真商事'),
(205, 2, '（株）岸和田商事'),
(251, 2, '（株）東洋銀行大阪支店'),
(252, 2, '（株）浪速海上保険'),
(253, 2, '（株）浪速倉庫'),
(254, 2, '（株）淀川運送');

-- --------------------------------------------------------

--
-- テーブルの構造 `deposit_master`
--

CREATE TABLE `deposit_master` (
  `deposit_cd` int(11) NOT NULL,
  `currency_cd` tinyint(4) NOT NULL COMMENT '1:円 2:dollar 3:euro 4:元 9:Etherium',
  `deposit_name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `deposit_master`
--

INSERT INTO `deposit_master` (`deposit_cd`, `currency_cd`, `deposit_name`) VALUES
(1, 1, '普通預金'),
(2, 1, '当座預金'),
(3, 1, '通知預金'),
(4, 1, '定期預金'),
(5, 1, '納税用預金');

-- --------------------------------------------------------

--
-- テーブルの構造 `job_master`
--

CREATE TABLE `job_master` (
  `job_cd` int(11) NOT NULL,
  `job_name` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `job_master`
--

INSERT INTO `job_master` (`job_cd`, `job_name`) VALUES
(1, '入金'),
(2, '出金'),
(3, '送金'),
(4, '口座開設'),
(5, '口座開設'),
(6, '外国為替'),
(7, '暗号資産取引');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `banking_transaction`
--
ALTER TABLE `banking_transaction`
  ADD PRIMARY KEY (`transaction_cd`),
  ADD KEY `transaction_timestamp` (`transaction_timestamp`),
  ADD KEY `job_cd` (`job_cd`),
  ADD KEY `my_account_cd` (`my_account_cd`),
  ADD KEY `other_account_cd` (`other_account_cd`);

--
-- テーブルのインデックス `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_account_cd`),
  ADD KEY `bank_cd` (`bank_cd`),
  ADD KEY `deposit_cd` (`deposit_cd`);

--
-- テーブルのインデックス `bank_master`
--
ALTER TABLE `bank_master`
  ADD PRIMARY KEY (`bank_cd`),
  ADD KEY `market_cd` (`market_cd`);

--
-- テーブルのインデックス `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`company_cd`),
  ADD KEY `market_cd` (`market_cd`);

--
-- テーブルのインデックス `deposit_master`
--
ALTER TABLE `deposit_master`
  ADD PRIMARY KEY (`deposit_cd`);

--
-- テーブルのインデックス `job_master`
--
ALTER TABLE `job_master`
  ADD PRIMARY KEY (`job_cd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
