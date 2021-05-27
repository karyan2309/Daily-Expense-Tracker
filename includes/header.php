<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<style>
    @media (max-width:768px){
  .user-action {

    display: none;
  }

  .user-action li {
    display: none;
  }
}
</style>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #f86e6e; width: 100vw;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                    
                <a class="navbar-brand" href="dashboard.php"><span>Daily Expense Tracker</span></a>
                
            </div>
            <ul class="nav navbar-nav navbar-right user-action" style="margin-top: -60px;">
                <li style="padding-top: 5px;"><a href="user-profile.php" style="color: white;"><span class="glyphicon glyphicon-user fa-lg" ></span><span></span><span style="padding-left: 6px;"> Profile</span></a></li>                        
                <li style="padding-top: 5px;"><a href="logout.php" style="color: white;"><span class="glyphicon glyphicon-log-in fa-lg" ></span><span style="padding-left: 6px;"> Logout</span></a></li>
            </ul> 
        </div>

        <!-- /.container-fluid -->
    </nav>
