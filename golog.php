<?php 
session_start();
include 'connect.php';

if (isset($_POST["register"])) {
$email = mysqli_real_escape_string($con, $_POST["email"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);

$emailq = "SELECT * FROM `user` WHERE email = '$email' ";
$emailqrun = mysqli_query($con, $emailq);

$ecount = mysqli_num_rows($emailqrun);

if ($ecount) {
    $emailorpass = mysqli_fetch_assoc($emailqrun);
    $dbpass = $emailorpass["password"];
    $pass_decode = password_verify($password, $dbpass);

    if ($pass_decode) {
        $_SESSION["logid"] =  $emailorpass["id"];
        header("location: dashboard.php");
    }else {
        $_SESSION["passinco"] = "Password incorrect";
        header("location: login.php");
    }
}
else {
    $_SESSION["invalidemail"] = "invalid email";
    header("location: login.php");
}

}

?>