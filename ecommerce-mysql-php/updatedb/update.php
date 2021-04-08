<?php
$user='root';
$pass='7807';
$host='localhost';
$db='crazyjoe';
$conn=mysqli_connect($host,$user,$pass,$db);

// check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
// check the action submited by the user in the if statment, send the query to the database and update the page.
$action =$_POST['submit'];
 
	if( $action == 'add game'){
	$name= $conn -> real_escape_string($_POST['gameName']);
	$rating=$_POST['rating'];
	$quantity=$_POST['quantity'];
	$cost=$_POST['cost'];
	$img=$_POST['img'];
	mysqli_query($conn, "insert into game values (default,'$name','$rating','$quantity','$cost','$img')");
	header ('Location: page.php');
	}
	else if($action == 'add customer'){
	$name= $conn -> real_escape_string($_POST['customerName']);
	$password= $conn -> real_escape_string($_POST['password']);
	$address=$_POST['address'];
	$store= $conn -> real_escape_string($_POST['store']);
	$phone=$_POST['phone'];
	$email=$conn -> real_escape_string($_POST['email']);
	$admin='false';
	$r = mysqli_query($conn, "insert into customer values (default,false,'$name','$email',MD5('$password'),'$store','$address','$phone')");
 	header ('location: page.php');
	}
        else if($action == 'add console'){
        $name=$_POST['consoleName'];
        $manufacturer=$_POST['manu'];
        $colour=$_POST['colour'];
	$cost=$_POST['cost'];
        $system=$_POST['system'];
	$quantity=$_POST['qty'];
	$img=$_POST['img'];
        mysqli_query($conn, "insert into console values (default,'false','$name','$colour','$manufacturer','$cost','$system','$quantity','$img')");
        header ('Location: page.php');
	}
	else if ($action == 'add sale'){
	$game_id =$_POST['game_id'];
	$customer_id=$_POST['customer_id'];
	$qty=$_POST['qty'];
	$date=$_POST['date'];
	$margin=$_POST['margin'];
	$total=$_POST['total'];
	$type =$_POST['type'];
	mysqli_query($conn, "insert into sales values (default, '$customer_id', '$game_id', '$total', '$date', '$qty', '$margin')");
	mysqli_query($conn, "insert into payment_method(payment_id, type, payment_date, customer_id) values (default, '$type', '$date', '$customer_id')"); 
	header('Location:page.php?action=empty'); 
	}
	else if($action == 'delete'){ 
	$id=$_POST['id'];
	mysqli_query($conn,"delete from game  where game_id  = ('$id')");
	header ('Location:games.php');
	}
	else{
	echo '<script language="javascript">';
	echo 'alert("Something went wrong")';
	echo '</script>';
	header ('Location: page.php');
	}
mysqli_close($conn);
?>
