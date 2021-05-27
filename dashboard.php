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
	<title>Daily Expense Tracker - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ExpenseItem', 'ExpenseCost'],
          <?php
		  $sql = "SELECT ExpenseItem, ExpenseCost FROM expenses WHERE ExpenseDate = CURDATE()";
		  $fire = mysqli_query($con, $sql); 
		  while($result = mysqli_fetch_assoc($fire)) {
			  echo"['".$result['ExpenseItem']."',".$result['ExpenseCost']."],";
		  } 
		  ?>
        ]);

        var options = {
          title: "Today's Expenses",
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>

<body>
	
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<i class="fas fa-home"></i>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		
		
		<div class="col-md-6">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
	<?php
	//Today Expense
	$userid=$_SESSION['detsuid'];
	$tdate=date('Y-m-d');
	$query=mysqli_query($con,"select sum(ExpenseCost)  as todaysexpense from expenses where (ExpenseDate)='$tdate' && (UserId='$userid');");
	$result=mysqli_fetch_array($query);
	$sum_today_expense=$result['todaysexpense'];
	 ?> 
	
							<h4>Today's Expense</h4>
							<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_expense;?>" ><span class="percent"><?php if($sum_today_expense==""){
	echo "0";
	} else {
	echo $sum_today_expense;
	}
	
		?></span></div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="panel panel-default">
						<?php
	//Yestreday Expense
	$userid=$_SESSION['detsuid'];
	$ydate=date('Y-m-d',strtotime("-1 days"));
	$query1=mysqli_query($con,"select sum(ExpenseCost)  as yesterdayexpense from expenses where (ExpenseDate)='$ydate' && (UserId='$userid');");
	$result1=mysqli_fetch_array($query1);
	$sum_yesterday_expense=$result1['yesterdayexpense'];
	 ?> 
						<div class="panel-body easypiechart-panel">
							<h4>Yesterday's Expense</h4>
							<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_expense;?>" ><span class="percent"><?php if($sum_yesterday_expense==""){
	echo "0";
	} else {
	echo $sum_yesterday_expense;
	}
	
		?></span></div>
						</div>
					</div>
				</div>
			</div>
				<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="panel panel-default">
	
						<?php
	
	//Weekly Expense
	$userid=$_SESSION['detsuid'];
	 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
	$crrntdte=date("Y-m-d");
	$query2=mysqli_query($con,"select sum(ExpenseCost)  as weeklyexpense from expenses where ((ExpenseDate) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
	$result2=mysqli_fetch_array($query2);
	$sum_weekly_expense=$result2['weeklyexpense'];
	 ?>
						<div class="panel-body easypiechart-panel">
							<h4>Last 7day's Expense</h4>
							<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_weekly_expense;?>"><span class="percent"><?php if($sum_weekly_expense==""){
	echo "0";
	} else {
	echo $sum_weekly_expense;
	}
	
		?></span></div>
						</div>
					</div>
				</div>
	
	
				<div class="col-xs-12 col-sm-6">
					<div class="panel panel-default">
						<?php
	//Total Expense
	$userid=$_SESSION['detsuid'];
	$query5=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from expenses where UserId='$userid';");
	$result5=mysqli_fetch_array($query5);
	$sum_total_expense=$result5['totalexpense'];
	 ?>
						<div class="panel-body easypiechart-panel">
							<h4>Total Expenses</h4>
							<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_expense;?>" ><span class="percent"><?php if($sum_total_expense==""){
	echo "0";
	} else {
	echo $sum_total_expense;
	}
	
		?></span></div>
	
	
						</div>
					
					</div>
	
				</div>
	
	
			</div>
		</div>
		<div class="col-md-6 ">
			<div id="piechart_3d"  style="width: 600px; height: 380px;"></div>
		</div>
		
		
		<!--/.row-->
	</div>	<!--/.main-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
<?php } ?>