<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$imgPath = '/crazyjoewebsite/images/';

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
        case "add":
                if(!empty($_POST["quantity"])) {
                        $productByCode = $db_handle->runQuery("SELECT * FROM game WHERE game_id='" . $_GET["game_id"] . "'");
                        $itemArray = array($productByCode[0]["game_id"]=>array('game_id'=>$productByCode[0]["game_id"], 'name'=>$productByCode[0]["name"], 'rating'=>$productByCode[0]["rating"], 'quantity'=>$_POST["quantity"], 'cost'=>$productByCode[0]["cost"], 'img'=>$productByCode[0]["img"]));

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




<?php include 'head.php' ?>

<div class="jumbotron">
  <div class="container text-center">
    <?php include 'main.php'; ?> 
  </div>
</div>


<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM game ORDER BY game_id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="page.php?action=add&game_id=<?php echo $product_array[$key]["game_id"]; ?>">
			<div class="product-image"><img src="<?php echo $imgPath . $product_array[$key]["img"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["cost"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>

</div>
<?php include 'footer.php' ?>
