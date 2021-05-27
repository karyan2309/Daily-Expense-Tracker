<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from users where  Email='$email' and MobileNumber='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
     header('location:reset-password.php');
    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Forgot Password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
</head>
<body style="padding-top:0 !important; height: 90vh; overflow: hidden">
<div class="bg-image" style=" padding-top: 60px; background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg'); height: 100vh; background-size: cover">
	<div class="row">
			<h2 align="center">Daily Expense Tracker</h2>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" style= "border: 5px solid rgb(235, 161, 161); border-radius: 15px; background-color: white; ">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" id="" name="login">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Mobile Number" name="contactno" type="contactno" value="" required="true">
							</div>
							<div class="checkbox" style="padding-top: 20px;">
								<button type="submit" value="" name="submit" class="btn btn-primary" style="background-color: #f86e6e; border-color: tomato;">Reset</button><span>
								<a href="index.php" class="btn btn-primary" style="background-color: #f86e6e; border-color: tomato;">Login</a></span>

							</div>
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</div>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
