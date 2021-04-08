<?php include 'head.php';
 if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true) ){
?>

<div class="container">
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Order by
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="customers.php?sort=name">Name</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="customers.php?sort=store">Storename</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="customers.php?sort=id">ID</a></li>
    </ul>
</div>
<?php

$user='root';
$pass='7807';
$host='localhost';
$db='crazyjoe';
$conn=mysqli_connect($host,$user,$pass,$db);
	
	if($_GET['sort'] == 'store'){
	$sql = "Select * from customer Order by store asc";
	}else if ($_GET['sort'] == 'name'){
	$sql = "Select * from customer order by name asc";
	}
	else if($_GET['sort'] == 'id'){
	$sql = "Select * from customer order by customer_id asc";
	}
	else {
	$sql = "Select * from customer";
	}
$result = mysqli_query($conn,$sql);
	echo "<h2>Customer</h2>
	<table>
        <tr>
        <th>Name</th>
        <th>Storename</th>
        <th>Address</th>
        <th>Phone</th>
        <th>ID</th>
       	</tr>";
        while($customer=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                print"<tr><td>". $customer['name']. "</td>";
		print"<td>". $customer['store']. "</td>";
                print"<td>". $customer['address']. "</td>";
                print"<td>". $customer['phone']. "</td>";
                print"<td>". $customer['customer_id']. "</td>";
        }
	print"</tr></table>";
?>
<h1>Enter a new user </h1>
<form action="update.php" method="post">
Name: <input type="text" name="customerName" value="" /><br>
Password: <input type="password" name="password" value="" /><br>
Store name: <input type="text" name="store" value="" /><br>
Address: <input type="text" name="address" value="" /><br>
Phone: <input type="text" name="phone" value="08"/><br>
<input type="submit" name="submit" class="btn btn-primary" value="add customer" />
</form>
<?php 
} else {
 echo"<p>You do not have access to this website please<a href='page.php'>go back to main page.</a></p>";
}
include 'footer.php'; ?>
