<?php include 'head.php';?>
<div class="container">
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Order by
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="consoles.php?sort=name">Name</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="consoles.php?sort=console_id">ID</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="consoles.php?sort=cost">Price</a></li>
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

	//sort games by the value selected from the dropdown menu.
	if($_GET['sort'] == 'game_id'){
	$sql = "Select * from console Order by game_id asc";
	}else if ($_GET['sort'] == 'name'){
	$sql = "Select * from console order by name asc";
	}
	else if($_GET['sort'] == 'manufacturer'){
	$sql = "Select * from console order by manufacturer asc";
	}
	else if($_GET['sort'] == 'cost') {
	$sql = "Select * from console order by cost asc";
	}
	else {
	$sql = "Select * from console";
	}

$result = mysqli_query($conn,$sql);
	echo "<h2>Consoles</h2>
        <table><form action='update.php' method='post' >
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Manufacturer</th>
        <th>Colour</th>
        <th>Price</th>
        <th>System</th>
        <th>Stock</th>
	<th>Action</th>
        </tr>";

	while ($console=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	// here is an input radio to get the id of a game row and delete it when clicking the delete button
	print"<tr><td><input type='radio' name='id' value={$console['console_id']} />". $console['console_id']. "</td>";
	print"<td><img  src='/crazyjoewebsite/images/" .$console['img'] . "' alt='".$console['name']. "'>" .  $console['name']. "</td>";
        print"<td>". $console['colour']. "</td>";
        print"<td>". $console['manufacturer']. "</td>";
        print"<td>". $console['cost']. "</td>";
	print"<td>". $console['system']. "</td>";
	// colours are assigned depending on stock level
	$color = ($console['quantity'] == 0) ? "style='color:red';" : (($console['quantity'] == 1) ? "style='color:yellow'; " : "style='color:green';");
	echo"<td " .$color.">". $console['quantity'] . "</td>";
	echo"<td>
        <input type='submit' name='submit' value='delete' />
        </td></tr>";
	}
	print"</form></table>";
?>
<h1> Enter a new console </h1>
<form action="update.php" method="post">
<div class="custom-control">
Name: <input type="text" name="consoleName" value"PS4" /><br>
Manufacturer: <input type="text" name="manu" value="Sony" /><br>
Colour: <input type="text" name="colour" value="" /><br>
Price:<input type="text" name="cost" value="" /><br>
Sysyem: <input type="text" name="system" value="PAL" /><br>
Quantity: <input type"text" name="qty" value="0" /><br>
Image: <input type="text" name="img" /><br>  
<input type="submit" name="submit" class="btn btn-primary" value="add console" />
</div>
</form>

<?php include 'footer.php'; ?>
