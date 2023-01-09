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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="descstyle.css">
    
    <title>Reports - <?php echo $website ; ?> </title>
</head>

<div class="mainbody">
    <div class="topprofile pd20">
        <div class="profile">
            <a href="user.php">
                <img src="
                <?php
                    if ($userjidetail["image"]) {
                     echo $userjidetail["image"];
                    }else {
                        echo "userimg/userprofile.png";
                    }
                ?>
                " alt="">
                <p class="name"><?php echo strtoupper($userjidetail["name"]) ; ?></p>
            </a>
        </div>
        <div class="wallet"><a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35px" height="35px"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 256C288 273.7 273.7 288 256 288C238.3 288 224 273.7 224 256V32C224 14.33 238.3 0 256 0C273.7 0 288 14.33 288 32V256zM80 256C80 353.2 158.8 432 256 432C353.2 432 432 353.2 432 256C432 201.6 407.3 152.9 368.5 120.6C354.9 109.3 353 89.13 364.3 75.54C375.6 61.95 395.8 60.1 409.4 71.4C462.2 115.4 496 181.8 496 255.1C496 388.5 388.5 496 256 496C123.5 496 16 388.5 16 255.1C16 181.8 49.75 115.4 102.6 71.4C116.2 60.1 136.4 61.95 147.7 75.54C158.1 89.13 157.1 109.3 143.5 120.6C104.7 152.9 80 201.6 80 256z"/></svg></a></div>
    </div>
    <!-- Profile section end   -->
<div class="lkjgg">
<?php require 'menuji.php' ; ?>

            <div class="dexkl">

                    <h1 class="sectitle pd20">Reports</h1>

                    <?php 

                                
                                $sqlji = "SELECT DISTINCT( MONTHNAME(date)) as jimonth FROM `exp` where user_id = '$user_id' ORDER BY date; ";
                                $sqljirun = mysqli_query($con, $sqlji); 
                                
                                $start = strtotime('first day of this month');

                                if ($sqljirun) {
                                if (mysqli_num_rows($sqljirun) >= 0) {
                                    while ($row = mysqli_fetch_assoc($sqljirun)) {
                                        ?>
                                            <div class="epft pd20">
                                                <a href="<?php echo "monthreport.php?month=".date("F", strtotime($row["jimonth"], $start) ) ; ?>" class="nmd">
                                                    <p class="hjl"><?php echo date("F", strtotime($row["jimonth"], $start) ) ; ?></p>
                                                    <span class="kln">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" width="16px" height="16px"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/></svg>
                                                    </span>
                                                </a>
                                            </div>                               
                                        <?php
                                            }
                                        }
                                    }
                                
                                
                            

                    ?>
            </div>
<div>
       </div>


<!-- home page   -->

</body>

</html>