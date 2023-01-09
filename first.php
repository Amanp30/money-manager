<?php
session_start() ;
include 'webdetail.php';
include 'connect.php';

if (!isset($_SESSION["logid"])) {
    header("location: login.php");
}

$user_id = $_SESSION["logid"];

$userji = "SELECT * FROM `user` WHERE id = '$user_id' ;";
$userjirun = mysqli_query($con, $userji);
$userjidetail = mysqli_fetch_assoc($userjirun);

$sqlji = "SELECT * FROM exp WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) AND user_id = '$user_id' ORDER BY `date` DESC limit 5; ";
$sqljirun = mysqli_query($con, $sqlji);

$total = "SELECT SUM(income) as total FROM `income` WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) AND users_id = '$user_id';";
$totalrun = mysqli_query($con, $total);
$totalincome = mysqli_fetch_assoc($totalrun);

$jiexpense = "SELECT SUM(expense) as jiexpense from `exp` WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) AND user_id = '$user_id';";
$jiexpenserun = mysqli_query($con, $jiexpense);
$jiexpenseincome = mysqli_fetch_assoc($jiexpenserun);

?>