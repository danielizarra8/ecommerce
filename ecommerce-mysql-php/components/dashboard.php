
<?php
include 'head.php';
require_once("dbcontroller.php");
$db = new DBController();


require_once("dbcontroller.php");
$db = new DBController();
$sql = $db->runQuery("SELECT * FROM sales WHERE customer_id='" . $_SESSION["user_id"] . "'");   
$total = $db->runQuery("select sum(total) from sales");
$items = $db->runQuery("select sum(quantity) from sales");
$t = $db->sumTotal("select sum(total) from sales");
// I try these o select the total sum and quanitity of sales in the sumTotal but they wouldn't work: select sum(total)  from sales;
//select sum(quantity)  from sales; 
?>

<div class="content-wrapper">
        <div class="container-fluid">
                        <!-- Breadcrumbs-->
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">My Dashboard</li>
                        </ol>
                        <!-- Icon Cards-->
			                        <div class="col-xl-3 col-sm-6 mb-3">
                                <div class="card text-white bg-danger o-hidden h-100">
                                        <div class="card-body">
                                                <div class="card-body-icon">
                                                        <i class="fa fa-fw fa-support"></i>
                                                </div>
                                                <div class="mr-5">TOTAL SALES: <?php echo json_encode($total); ?></div>
                                                        <a class="card-footer text-white clearfix small z-1" href="#">
                                                        <span class="float-left">View Details</span>
                                                        <span class="float-right">
                                                        <i class="fa fa-angle-right"></i>
                                                        </span>
                                                        </a>
                                        </div>
                                </div>
                        </div>	
                        <div class="col-xl-3 col-sm-6 mb-3">
                                <div class="card text-white bg-danger o-hidden h-100">
                                        <div class="card-body">
                                                <div class="card-body-icon">
                                                        <i class="fa fa-fw fa-support"></i>
                                                </div>
                                                <div class="mr-5">TOTAL ITEMS <?php echo json_encode($items); ?></div>
                                                        <a class="card-footer text-white clearfix small z-1" href="#">
                                                        <span class="float-left">View Details</span>
                                                        <span class="float-right">
                                                        <i class="fa fa-angle-right"></i>
                                                        </span>
                                                        </a>
                                        </div>
                                </div>
                        </div>
                        <?php
                        $sql1 = $db->runQuery("SELECT * FROM sales WHERE customer_id='" . $_SESSION["user_id"] . "'");

                        foreach ($sql1 as $item){    
                        ?>
                        <script type="text/javascript">
                        window.dataf= <?php echo $item['sale_id']; }?>
                        </script>
                        <!-- Area Chart Example-->
                </div> <!-- ROW END-->
                        <div class="card mb-3">
                                <div class="card-header">
                                        <i class="fa fa-area-chart"></i> Sales Chart
                                </div>
                                <div class="card-body">
                                        <canvas id="myAreaChart" width="100%" height="30"></canvas>                   
                        	</div>
                	</div>
        </div>
</div>


  
<?php include 'footer.php'; ?>
