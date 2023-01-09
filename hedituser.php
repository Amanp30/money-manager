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

$oldimage = $userjidetail["image"];


if (isset($_POST["update"])) {
    $name = $_POST["username"];
    $state = $_POST["state"];
    $mobileno = $_POST["mobileno"];

     /* FIle name variables */
    $file = $_FILES['file'];
    $filename = $file['name'];
    $filepath = $file['tmp_name'];
    $fileerror = $file['error'];

    
    if ($fileerror == 0 ) {
            $destfile = './userimg/'. $filename;
            move_uploaded_file($filepath, $destfile);

            if (isset($destfile)) {
                $updateuser = "UPDATE `user` SET `name`='$name',`image`='$destfile',`state`='$state',`phone`='$mobileno' WHERE `id` = '$user_id';";
                $updateuserque = mysqli_query($con, $updateuser);
                header("location: user.php");
            }   

        } else {
                $updateuser = "UPDATE `user` SET `name`='$name',`image`='$oldimage',`state`='$state',`phone`='$mobileno' WHERE `id` = '$user_id';";
                $updateuserque = mysqli_query($con, $updateuser);
                header("location: user.php");
            }


}


?>