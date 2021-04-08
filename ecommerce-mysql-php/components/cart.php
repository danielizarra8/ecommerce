<?php include 'head.php' ?>

<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$imgPath = '/crazyjoewebsite/images/';

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
        case "add":
                if(!empty($_POST["quantity"])) {
                        $productByCode = $db_handle->runQuery("SELECT * FROM game WHERE game_id='" . $_GET["game_id"] . "'");
                        $itemArray = array($productByCode[0]["game_id"]=>array('name'=>$productByCode[0]["name"], 'rating'=>$productByCode[0]["rating"], 'quantity'=>$_POST["quantity"], 'cost'=>$productByCode[0]["cost"], 'img'=>$productByCode[0]["img"]));

                        if(!empty($_SESSION["cart_item"])) {
                                if(in_array($productByCode[0]["game_id"],array_keys($_SESSION["cart_item"]))) {
                                        foreach($_SESSION["cart_item"] as $k => $v) {
                                                        if($productByCode[0]["game_id"] == $k) {
                                                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                                                }
                                                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                                        }
                                        }
                                } else {
                                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                                }
                        } else {
                                $_SESSION["cart_item"] = $itemArray;
                        }
                }
        break;
        case "remove":
                if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                        if($_GET["game_id"] == $k)
                                                unset($_SESSION["cart_item"][$k]);
                                        if(empty($_SESSION["cart_item"]))
                                                unset($_SESSION["cart_item"]);
                        }
                }
        break;
        case "empty":
                unset($_SESSION["cart_item"]);
        break;
}
}
?>

<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="page.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["cost"];
                ?>
                                <tr>
                                <td><img src="<?php echo $imgPath . $item["img"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["game_id"]; ?></td>
                                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                <td  style="text-align:right;"><?php echo "$ ".$item["cost"]; ?></td>
                                <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                                <td style="text-align:center;"><a href="page.php?action=remove&game_id=<?php echo $item["game_id"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                </tr>
                                <?php
                                $total_quantity += $item["quantity"];
                                $total_price += ($item["cost"]*$item["quantity"]);
				$game_id = $item["game_id"];
                }
                ?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

</div>
<form action="update.php" method="post">
<div>
<input type="hidden" name="customer_id" value=<?php echo $_SESSION['user_id'] ?> /><br>
<input type="hidden" name="game_id" value= <?php echo $game_id ?> /><br>
<input type="hidden" name="qty" value= <?php echo $total_quantity ?> /><br>
<input type="hidden" name="date" value="2021-01-11" ><br>
<input type="hidden" name="margin" value="0"/><br>>
<input type="hidden" name="total" value=<?php echo $total_price ?> />
<h3>PAYMENT </h3>
Payment type: <select name="type"><br>
                <option value="debit">Debit</option>
                <option value="paypal">Paypal</option>
                <option value="bitcoin">Bitcoin</option>
                </select><br>
       <?php
	if((isset($_SESSION['username']) && (!empty($_SESSION["cart_item"])) )){
		echo "<input type='submit' name='submit' class='btn btn-primary' value='add sale' />";	
	} 
	else if(!isset($_SESSION['username'] )){ 
                echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>Log in</a></li>";
        }
        else{
                echo "<li>Your cart is empty,<a href='page.php'>Add some items to your cart!</a></li>";
         } 
        ?>
</div>

</form>
<?php include 'footer.php' ?>
