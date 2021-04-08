<?php include 'head.php' ?>

<?php
	ob_start();
	require_once("dbcontroller.php");
	$db = new DBController();
     	$msg = '';

	if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
		 $sql = $db->runQuery("SELECT * FROM customer WHERE email='" . $_POST["username"] . "'");
               if ($_POST['username'] == $sql[0]['email'] && 
                  MD5($_POST['password']) == $sql[0]['password']) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $sql[0]['name'];
		  $_SESSION['email'] = $sql[0]['email'];
		  $_SESSION['user_id'] = $sql[0]['customer_id'];
			if($sql[0]['admin'] == true){
			    $_SESSION['admin'] = $sql[0]['admin'];
			}
                  echo 'You have entered valid use name and password';
		 header('Refresh: 1; URL = page.php');
               }else {
                  $msg = 'Wrong username or password ';
               }
            }
         ?>


<div id="login">
	<h2>Log in</h2>
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "email" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
</div>
<?php include 'footer.php' ?>
