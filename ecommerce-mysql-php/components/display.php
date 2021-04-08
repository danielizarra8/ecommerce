<?php

include 'head.php';
$user='root';
$pass='7807';
$host='localhost';
$db='crazyjoe';
$conn=mysqli_connect($host,$user,$pass,$db); 
$array=$_GET['array'];
$path= $array['img'];
echo	"<div class='card' >
	<img class='card-img-top' src='/crazyjoewebsite/images/" .$path. "' alt='".$array['name']. "'> \n 
	<div class='card-body'>
	<h4 class='card-title'>Name: " . $array['name'] . "</h4> \n 
	<h4 class='card-title'>Game ID: " . $array['game_id'] . "</h4> \n
	<h4 class='card-title'>Rating: " . $array['rating'] . "</h4> \n
	<h4 class='card-title'>Quantity: " . $array['quantity'] . "</h4> \n
	<h4 class='card-title'>Price: " . $array['cost'] . "</h4> \n 
	</div></div>";


?>
