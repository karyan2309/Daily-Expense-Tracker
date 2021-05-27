<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Datewise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	  google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
			['ExpenseCategory', 'TotalCost',],
		  <?php
		        $fdate=$_POST['fromdate'];
				$tdate=$_POST['todate'];
			    $rtype=$_POST['requesttype'];
				$userid=$_SESSION['detsuid'];
		        $sql = "SELECT ExpenseCategory, SUM(ExpenseCost) as TotalCost FROM `expenses` WHERE (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') GROUP BY ExpenseCategory";
			    $fire = mysqli_query($con, $sql);
			    while($result = mysqli_fetch_assoc($fire)){
			 	echo"['".$result['ExpenseCategory']."',".$result['TotalCost']."],";
			    }
		  ?>
        ]);

        var options = {
          width: 500,
          legend: { position: 'none' },
		  role: { style: '#f38080'},
          chart: {
            title: 'Expense Report',
            subtitle: 'Categories:' },
          axes: {
            x: {
              0: { side: 'bottom', label: 'Category'} // Top x-axis.
            }
          },
          bar: { groupWidth: "70%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
	</script>
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Datewise Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		<div class="col-md-6">
            <div class="row">
				<div class="col-lg-12" style="margin-top: 50px;">
				
					
					
					<div class="panel panel-default">
						<div class="panel-heading">Datewise Expense Report</div>
						<div class="panel-body">
	
							<div class="col-md-12">
						
	<?php
	$fdate=$_POST['fromdate'];
	 $tdate=$_POST['todate'];
	$rtype=$_POST['requesttype'];
	?>
	<h5 align="center" style="color:blue">Datewise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
	<hr />
			<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
					    <tr>
				            <th>S.NO</th>
				            <th>Date</th>
				            <th>Category</th>
				            <th>Expense Amount</th>
					    </tr>
					</tr>
				</thead>
	 <?php
	$userid=$_SESSION['detsuid'];
	$ret=mysqli_query($con,"SELECT ExpenseDate,ExpenseCategory,SUM(ExpenseCost) as totaldaily FROM `expenses`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by ExpenseDate");
	$cnt=1;
	while ($row=mysqli_fetch_array($ret)) {
	
	?>
				  
					<tr>
					  <td><?php echo $cnt;?></td>
				      
					  <td><?php  echo $row['ExpenseDate'];?></td>
					  <td><?php  echo $row['ExpenseCategory'];?></td>
					  <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
			   
			   
					</tr>
					<?php
					$totalsexp+=$ttlsl; 
	$cnt=$cnt+1;
	}?>
	
	 <tr>
	  <th colspan="2" style="text-align:center">Grand Total</th>     
	  <td><?php echo $totalsexp;?></td>
	 </tr>     
	
										</table>
	
	
	
	
							</div>
						</div>
					</div><!-- /.panel-->
				</div><!-- /.col-->
				
			</div><!-- /.row -->

		</div><!--column -->
		<div class="col-md-6" style="margin-top: 50px;">
		        <div id="top_x_div" style="width: 100%; height: 520px; padding:20px; background: white; padding-left: 45px;"></div>
            
			
		</div>
		
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php } ?>