<?php
try {
$host ='localhost';
$dbname="meta";
$user="root";
$pass="root";

  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
mysql_query('SET NAMES "utf8";');
mysql_query('SET CHARACTER SET "utf8";');
mysql_query('SET COLLATION_CONNECTION = "utf8_general_ci";');

  }
catch(PDOException $e) {
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
	

$keyword = $_POST['keyword'].'%';
$sql = "SELECT * FROM utilizador WHERE utilizador LIKE (:keyword) ORDER BY id_ut ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
		// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['utilizador']).'\')">'.$rs['utilizador'].'</li>';
}
?>