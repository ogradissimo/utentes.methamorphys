<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
include  'cont.php';


	$STH5 = $DBH -> prepare("SELECT utilizador FROM utilizador where utilizador LIKE 'p%'");	
	$STH5->execute();
	$data= array();
	while ($row = $STH5 -> fetch())   {
		array_push($data, $row['utilizador']);	
	}	
	echo json_encode($data);

?>