
<?php include 'head.php'; ?>
	<?php
	require_once("dbcontroller.php");
	$db = new DBController();
	  $sql = $db->runQuery("SELECT * FROM sales WHERE customer_id='" . $_SESSION["user_id"] . "'");
	?>

<div>
	<h2>Your Account</h2>
        <table>
        <tr>
        <th>Sale ID</th>	
        <th>Date</th>
        <th>Quantity</th>
        <th>Total</th>
        </tr>
	<?php
	    foreach ($sql as $item){	
        echo"<tr><td>". $item['sale_id']. "</td>";
        echo"<td>". $item['sale_date']. "</td>";
        echo"<td>". $item['quantity']. "</td>";
        echo"<td>". $item['total']. "</td>";
	echo"</tr>";
	}
	?>
       	</table>	
</div>



<div class="container d-flex justify-content-center mt-100">
    <!-- Button to Open the Modal --> <button type="button" class="btn openmodal" data-toggle="modal" data-target="#modal1"> Click here </button> <!-- The Modal -->
    <div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Adidas Yeezy Boost 350 V2<br> Limited Edition</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <h6>Item Details</h6>
                        <div class="row">
                            <div class="col-xs-6" style="padding-top: 2vh;">
                                <ul>
                                    <li><?php echo $_SESSION['username'] ?></li>
                                </ul>
                            </div>
                        </div>
                        <h6>Order Details</h6>
                        <div class="row">
                            <div class="col-xs-6">
                                <ul class="ulist">
                                    <li class="left">Order number:</li>
                                    <li class="left">Date:</li>
                                    <li class="left">Price:</li>
                                    <li class="left">Shipping:</li>
                                    <li class="left">Total Price:</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul class="left" >
                                    <li>#BBRT-3456981</li>
                                    <li>19-03-2020</li>
                                    <li>$690</li>
                                    <li>$30</li>
                                    <li>$720</li>
                                </ul>
                            </div>
                        </div>
                        <h6>Shipment</h6>
                        <div class="row" style="border-bottom: none">
                            <div class="col-xs-6">
                                <ul class="ulist">
                                    <li class="left">Estimated arrival</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul>
                                    <li class="left">25-03-2020</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- Modal footer -->
                <div class="modal-footer"> <button type="button" class="btn">Track order</button> </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
