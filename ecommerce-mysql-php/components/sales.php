<?php include 'head.php';
if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true) ){ 

?>
<div class="container">
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
	$sql = "Select * from sales";
	}
$result = mysqli_query($conn,$sql);
	echo"<h2>Sales</h2>
        <table>
       	<tr>
        <th>Sale ID</th>
        <th>Customer</th>
        <th>Items bought</th>
        <th>Game ID</th>
        <th>Date</th>
	<th>Margin</th>
	<th>Total</th>
        </tr>";
        while($sales=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                print"<tr><td>". $sales['sale_id'] . "</td>";
                print"<td>". $sales['customer_id']. "</td>";
                print"<td>". $sales['quantity']. "<spam> Copies </spam></td>";
                print"<td>". $sales['game_id']. "</td>";
		print"<td>". $sales['sale_date']. "</td>";
		print"<td>". $sales['margin']. "<spam>%</spam></td>";
		print"<td>". $sales['total']. "<spam>$</spam></td>";
        }
                print"</tr></table>";
?>
<h1>Add a new sale </h1>
<form action="update.php" method="post">
Customer ID: <input type="text" name="customer_id" /><br>
Game ID: <input type="text" name="game_id" /><br>
Quantity: <input type="text" name="qty" value="0"/><br>
Date: <input type="date" name="date" value="2021-01-11" ><br>
Margin: <select name="margin"><br>
		<option value="0">0%</option>
		<option value="5">5%</option>
		<option value="10">10%</option>
	</select><br>
Total: <input type="text" name="total" /><br>
<input type="submit" name="submit" class="btn btn-primary" value="add sale" />
</form>

<?php 
} else {
 echo"<p>You do not have access to this website please<a href='page.php'>go back to main page.</a></p>";
}

include 'footer.php'; ?>
