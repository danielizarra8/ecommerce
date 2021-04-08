<?php include 'head.php'; ?>
<div>
<h1>Sign up </h1>
<form action="update.php" method="post">
Name: <input type="text" name="customerName" value="" /><br>
Email: <input type="text" name="email" value="" /><br>
Password: <input type="password" name="password" value="" /><br>
Store name: <input type="text" name="store" value="" /><br>
Address: <input type="text" name="address" value="" /><br>
Phone: <input type="text" name="phone" value="08"/><br>
<input type="submit" name="submit" class="btn btn-primary" value="add customer" />
</form>
</div>
<?php include 'footer.php'; ?>
