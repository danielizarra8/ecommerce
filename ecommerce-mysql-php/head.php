<?php
session_start();
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Crazy joe website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="style.css" type="text/css" rel="stylesheet" /> 

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script> 
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="page.php">Crazyjoe</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="page.php">Home</a></li>
        <?php if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true) ){ 
	echo"<li><a href='games.php'>Games</a></li>";
	echo"<li><a href='consoles.php'>Consoles</a></li>"; 
	echo"<li><a href='customers.php'>Customers</a></li>";
	echo"<li><a href='sales.php'>Sales</a></li>";
	echo"<li><a href='dashboard.php'>Dashboard</a></li>";
	} else {
	echo"<li><a href='gameScreen.php'>Games</a></li>";
        echo"<li><a href='consoleScreen.php'>Consoles</a></li>";
	}
	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	<?php if(!(isset($_SESSION['admin'])) && (!isset($_SESSION['username'])) ){ 
                echo "<li><a href='signup.php'>Sign up</a></li>";
        } 
        ?>
       <?php if(!isset($_SESSION['username'])){ 
		echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>Log in</a></li>";
		
	}
	else{
		echo "<li><a href='youraccount.php'>Welcome " . $_SESSION['username'] . "!</a></li>";
		echo "<li><a href='logout.php'>Log out</a></li>";
	} 
	?>
      	<li><a href="cart.php"><span class="glyphicon glyphicon-cart"></span> Cart</a></li>	
      </ul>
    </div>
  </div>
</nav>


</head>
<body>
