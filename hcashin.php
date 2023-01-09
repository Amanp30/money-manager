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

if (isset($_POST["cashin"])) {
    $DESCRIPTION = $_POST["remark"];
    $amount = $_POST["amount"];
    $cashdate = $_POST["cashdate"];
    
    #$newuser = "INSERT INTO `exp`(`id`, `date`, `expense`, `description`, `image`, `type`, `user_id`) VALUES (null,$cashdate,$amount,$DESCRIPTION, $user_id)";

    $updateuser = "INSERT INTO `income`( `date`, `income`, `users_id`, `description`) VALUES ('$cashdate','$amount','$user_id','$DESCRIPTION')";

if (mysqli_query($con, $updateuser)) {
      header("location: dashboard.php");
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);

}


?>