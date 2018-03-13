<?php

try {
$host ='methamorphys.pt';
$dbname="utentes_metha";
$user="tpsidb";
$pass="W@ko@io@tpsi";

  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
mysql_query('SET NAMES "utf8";');
mysql_query('SET CHARACTER SET "utf8";');
mysql_query('SET COLLATION_CONNECTION = "utf8_general_ci";');

  }
catch(PDOException $e) {
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
	
 ?>
