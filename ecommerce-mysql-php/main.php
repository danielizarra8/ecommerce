<?php
$user='root';
$pass='7807';
$host='localhost';
$db='crazyjoe';
$conn=mysqli_connect($host,$user,$pass,$db);
// i query into my db to select game by id and sum the number of game sold in the sales tables and the top 5 games are pulled from the db
$result=mysqli_query($conn,'select game_id,sum(quantity) as Total from sales group by game_id order by sum(quantity) desc limit 5');
$count = 1;
	echo "<div style='background-image:url(/crazyjoewebsite/images/wood.jpg');background-repeat:repeat'>
	      <h1 style='color:#ffffe6'> Crazy joe's top 5 </h1>";
	while ($row = mysqli_fetch_assoc($result)){
	$x = "select * from game where game_id = " . $row['game_id'];
	$name = mysqli_query($conn,$x);
	while($games=mysqli_fetch_array($name,MYSQLI_ASSOC)){
		// i used the http_build_query to send the game data into an array so i can display it in the display.php
                $q = http_build_query(Array( 'array' => $games));
                echo " <ul style='color:#ffff99'>
			<li style='list-style-type: none;'><a style='color:#ffff99;font-size:19px' href='display.php?{$q}'>". $count . " - " . $games['name'] . "</a></li>	
			</ul>";
		echo "\n";
		$count++;
	}
}
        echo "</div>";
?>


