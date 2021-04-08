
<?php include 'head.php'; 

require_once("dbcontroller.php");
$db_handle = new DBController();

?>


<div id="product-grid">
        <div class="txt-heading">Consoles</div>
        <?php
        $product_array = $db_handle->runQuery("SELECT * FROM console ORDER BY console_id ASC");
        $imgPath = '/crazyjoewebsite/images/';
        if (!empty($product_array)) { 
                foreach($product_array as $key=>$value){
        ?>
                <div class="product-item">
                        <form method="post" action="page.php?action=add&game_id=<?php echo $product_array[$key]["console_id"]; ?>">
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
<?php include 'footer.php'; ?>

