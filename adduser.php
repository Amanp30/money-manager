<?php 

session_start();

include 'connect.php';

if (isset($_POST["register"])) {
$name = mysqli_real_escape_string($con, $_POST["name"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$confirmpassword = mysqli_real_escape_string($con, $_POST["confirmpassword"]);

$pass = password_hash($password, PASSWORD_BCRYPT);
$cpass = password_hash($confirmpassword, PASSWORD_BCRYPT);

$emailq = "SELECT * FROM `user` WHERE email = '$email' ";
$emailqrun = mysqli_query($con, $emailq);

$ecount = mysqli_num_rows($emailqrun);

if ($ecount > 0) {
    $_SESSION["exist"] = "exist emai id" ; 
}
else {
    if ($password === $confirmpassword) {
        $insertuser = "INSERT INTO `user`(`id`, `name`, `email`, `password`, `confirmpassword`) VALUES (null ,'$name','$email','$pass','$cpass')";
        $insertuserrun = mysqli_query($con, $insertuser);

        if ($insertuserrun) {
            $_SESSION["inserted"] = "data insert " ; 
        }

    }
    else {
            $_SESSION["passnot"] = "passnot match" ; 
    }
}

}

header("location:register.php");
?>