<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// $fdate=$_POST['fromdate'];
// $tdate=$_POST['todate'];
// $rtype=$_POST['requesttype'];
// $userid=$_SESSION['detsuid'];
// $sql="SELECT * FROM `expenses`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid')";
// $res=mysqli_query($con,$sql);
// $html='
//     <table>
//         <tr>
//             <td>Sno</td>
//             <td>Expense Date</td>
//             <td>Expense Category</td>
//             <td>Expense Item</td>
//             <td>Expense Cost</td>
//         </tr>';
//     $count = 1;
//     while($row=mysqli_fetch_assoc($res)){
//         $html.='
//             <tr>
//                 <td>'.$row['count'].'</td>
//                 <td>'.$row['ExpenseDate'].'</td>
//                 <td>'.$row['ExpenseCategory'].'</td>
//                 <td>'.$row['ExpenseItem'].'</td>
//                 <td>'.$row['ExpenseCost'].'</td>
//             </tr>';
//         $count = $count + 1;    
//     }
// $html='</table>';


$output = '';
if(isset($_POST["submit_report"]))
{
    $fdate=$_POST['fromdate'];
    $tdate=$_POST['todate'];
    $rtype=$_POST['requesttype'];
    $userid=$_SESSION['detsuid'];
    $sql="SELECT * FROM `expenses`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid')";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0)
    {
        $output .= '
            <table class="table" bordered="1" >
                <tr>
                    <td>Sno</td>
                    <td>Expense Date</td>
                    <td>Expense Category</td>
                    <td>Expense Item</td>
                    <td>Expense Cost</td>
                </tr> 
        ';
        $count = 1;
        while($row=mysqli_fetch_array($res))
        {
            $output .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$row['ExpenseDate'].'</td>
                    <td>'.$row['ExpenseCategory'].'</td>
                    <td>'.$row['ExpenseItem'].'</td>
                    <td>'.$row['ExpenseCost'].'</td>
                </tr>
            ';
            $count = $count + 1;
        }
        $output .='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment; filename=report.xls');
        echo $output;
    }

}
// header('Content-Type:application/xls');
// header('Content-Disposition:attachment; filename=report.xls');
// echo $html;
?>