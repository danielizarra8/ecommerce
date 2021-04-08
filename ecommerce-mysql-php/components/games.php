<?php include 'head.php';
 if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true) ){ 

?>
<div class="container">
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Order by
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="games.php?sort=name">Name</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="games.php?sort=cost">Cost</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="games.php?sort=rating">Rating</a></li>
    </ul>
  </div>
<?php
$user='root';
$pass='7807';
$host='localhost';
$db='crazyjoe';
$conn=mysqli_connect($host,$user,$pass,$db);

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

	if($_GET['sort'] == 'cost'){
	$sql = "Select * from game Order by cost asc";
	}else if ($_GET['sort'] == 'name'){
	$sql = "Select * from game order by name asc";
	}
	else if($_GET['sort'] == 'rating'){
	$sql = "Select * from game order by rating asc";
	}
	else {
	$sql = "Select * from game";
	}

$result = mysqli_query($conn,$sql);
	
	echo "<h2>Games</h2>
	<table><form action='update.php' method='post'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age Rating</th>
        <th>Cost</th>
        <th>Stock</th>
	<th>Action</th>
        </tr>";
        while($games=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		print"<tr><td><input type='radio' name='id' value={$games['game_id']} />".$games['game_id']."</td>";
		$q = http_build_query(Array( 'array' => $games));
		print"<td><a href='display.php?{$q}'>". $games['name'] . "</td></a>";
		print"<td>". $games['rating']. "</td>";
		print"<td>". $games['cost']. "</td>";
		/* red for stock level = 0, between 1 and 4 yellow and more than 4 green   */
		$color = ($games['quantity'] == 0) ? "style='color:#ff0000';" : (($games['quantity'] > 0 && $games['quantity'] < 4) ? "style='color:#cc7a00'; " : "style='color:#00802b';");
		print"<td ".$color.">". $games['quantity']. "</td>";
		print"<td>
                <input type='submit' name='submit' value='delete' />
        	</td></tr>";
        }
		print"</form></table>";
?>
//I didn't set any form validation for any of the forms in the project as I didn't have time.
<h1>Add a new game </h1>
<form action="update.php" method="post">
<div class="custom-control custom-checkbox mb-3">
Name: <input type="text"  name="gameName" class="" value="Fifa 15" /><br>
Raiting: <input type="text" name="rating" value="10" /><br>
Quantity: <input type="text" name="quantity" value="1" /><br>
Price: <input type="text" name="cost" value="2"/><br>
<!-- the image input should be of type file and upload the img to image folder and then assign the path into the databse. I couldn't figure it out. -->
Image: <input type="text" name="img" /><br>
<input type="submit" name="submit" class="btn btn-primary" value="add game" />
<div>
</form>

<?php 
} else {
 echo"<p>You do not have access to this website please<a href='page.php'>go back to main page.</a></p>";
}
include 'footer.php'; ?>
