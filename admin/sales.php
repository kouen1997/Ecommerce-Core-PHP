<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
error_reporting(0);
include 'includes/head.php';
include 'includes/navigation.php';
?>

<div class="row">
<?php 
$thisYr = date("Y");
$lastYr = $thisYr - 1;
$thisYrQ = $db->query("SELECT total, txn_date FROM transaction WHERE YEAR(txn_date) = '{$thisYr}'");
$lastYrQ = $db->query("SELECT total, txn_date FROM transaction WHERE YEAR(txn_date) = '{$lastYr}'");
$current = array();
$last = array();
$currentTotal = 0;
$lastTotal = 0;
$tot = array();
while($x = mysqli_fetch_assoc($thisYrQ)){
$month = date("m",strtotime($x['txn_date']));
if(!array_key_exists($month,$current)){
	$current[(int)$month] += $x['total'];
	}else{
	$current[(int)$month] = $x['total'];
	}
	$currentTotal += $x['total'];
	}
	while($y = mysqli_fetch_assoc($lastYrQ)){
		$month = date("m",strtotime($y['txn_date']));
	if(!array_key_exists($month,$current)){
	$last[(int)$month] += $y['total'];
	}else{
	$last[(int)$month] = $y['total'];
	}
	$lastTotal += $y['total'];
	}


?>
</form>
<div class="col-md-4">
<h3 class="text-center">Sales By Month</h3>
<table class="table table-striped table-bordered">
<thead>
<th></th>
<th><?=$lastYr;?></th>
<th><?=$thisYr;?></th>
</thead>
<tbody>
<?php for($i = 1;$i <= 12;$i++):
$dt = DateTime::createFromFormat('!m',$i);
?>
<tr>
<td><?=$dt->format("F");?></td>
<td><?=(array_key_exists($i,$last))?money($last[$i]):money(0);?></td>
<td><?=(array_key_exists($i,$current))?money($current[$i]):money(0);?></td>
</tr>
<?php endfor; ?>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td>Total</td>
<td><?=money($lastTotal);?></td>
<td><?=money($currentTotal);?></td>
</tr>
</tbody>
</table>
 
<form action='sales.php' method='post'>
<input type='text' name='last' value='<?=$lastTotal;?>'>
<input type='text' name='cur' value='<?=$currentTotal;?>'>
<input type='submit' name='submit' value='submit'>
</form>

<?php
if(isset($_POST['submit'])){
$last = $_POST['last'];
$cur = $_POST['cur'];
$sql = "UPDATE sales SET last = '$last', current ='$cur' WHERE id = 22";
$db->query($sql);
var_dump($sql);
}
?>
</div>
    <script src="js/jquery.js" type="text/javascript"></script>


    <script type="application/javascript" src="js/awesomechart.js"> </script>

<?php
mysql_select_db('ejv_db',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<style>
.whole{
position: fixed;
margin-left: 500px;
height: 100%;
width: 60%;

}
#font{
margin-top: 20px;
margin-left: 30px;
font-size:30px;
}
</style>
 

<body>
	<div class='whole'>
	<div id='font'>&nbsp;&nbsp;&nbsp;&nbsp;Graphical Sales Presentation(Last - Current)</div>
            <div class="container">
			
                <div class="row-fluid">
                    <div class="span12">
                        <div class="hero-unit-table">
                            <div class="charts_container">
                                <div class="chart_container">
                                    
                                    <canvas id="motorcycle_graph" width="600" height="600">
                                        Your web-browser does not support the HTML 5 canvas element.
                                    </canvas>
                                </div>
                            </div>
						</div>




<script type="application/javascript">
    var motorcycle_chart = new AwesomeChart('motorcycle_graph');
    motorcycle_chart.data = [
    <?php
    $query = mysql_query("select * from sales") or die(mysql_error());
    while ($row = mysql_fetch_array($query)) {
        ?>
        <?php echo $row['last'] . ','.$row['current']; ?>	
    <?php }; ?>
    ];
    motorcycle_chart.labels = ['Last Year','This Year'
    ];

    motorcycle_chart.colors = ['green', 'green'];
    motorcycle_chart.randomColors = true;
    motorcycle_chart.animate = true;
    motorcycle_chart.animate = true;
    motorcycle_chart.draw();
</script>
                        </div>
                    </div>
					</div>
					</div>
				
      

