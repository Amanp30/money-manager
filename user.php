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


$premium = "SELECT * FROM `subscriber` WHERE userjiid = '$user_id' ;";
$premiumrun = mysqli_query($con, $premium);
$premiumdetail = mysqli_fetch_assoc($premiumrun);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="descstyle.css">
    <title>User - <?php echo $website ; ?> </title>
</head>
<div class="mainbody">

    <div class="lkjgg">
        <?php require 'menuji.php' ; ?>
            <div class="dexkl">


                <div class="user">
                    <div class="userprofilesjk">
                        <img src="<?php
                            if ($userjidetail["image"]) {
                                echo $userjidetail["image"];
                            }else {
                                echo "userimg/userprofile.png";
                                    }
                        ?>" alt="">

                        <h2 class="username">
                            <?php echo strtoupper($userjidetail["name"]) ; ?>
                        </h2>
                        
                        <p class="state">
                        <span>STATE</span>  <span>
                            <?php 
                                            if ($userjidetail["state"]) {
                                                echo strtoupper($userjidetail["state"]) ;
                                            }
                                            else {
                                                echo "- - - - -";
                                            }
                        ?>
                        </span>
                        </p>
                        <p class="phone">
                        <span>MOBILE NO</span>  <span>
                            <?php 
                                            if ($userjidetail["phone"]) {
                                                echo strtoupper($userjidetail["phone"]) ;
                                            }
                                            else {
                                                echo "- - - - -" ;
                                            } ?>
                        </span>
                        </p>
                        <p class="phone">
                        <span>Subscriber</span>  <span>
                            <?php 
                                            if (mysqli_num_rows($premiumrun) == 1) {
                                                echo "Premium" ;
                                            }
                                            else {
                                                echo "Basic";
                                                 ?>
                                                    <div class="notfound">
                                                        <p class="jitext pd20">
                                                            <span class="kjl">
                                                            Subscribe to premium plan  <br> <a href="#" class="jisubscribe" onclick="jishowfunction()">Subscribe Now</a>
                                                        </p>
                                                    </div>

                                                    

                                                    <div class="subscribepremium">
                                                        <form action="subscribe.php" method="post" class="subscribeform">
                                                            <p class="spanop">Subscribe to premium</p>

                                                            <div class="jicloseji" onclick="jiclose()">x</div>

                                                            <div class="ffielgdgf">
                                                                <label for="promocode">Enter Promocode</label>
                                                                <input type="text" name="promocode" class="jipromocode">
                                                            </div>
                                                            <div class="jdgsubmit">
                                                                <input type="submit" value="Apply Promocode" name="jipromocode">
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php
                                            } ?>
                        </span>
                        </p>


                        <a href="edituser.php"><BUTTON class="EDITUSER">EDIT PROFILE</BUTTON></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- home page   -->


    <script src="promocode.js"></script>

</body>

</html>