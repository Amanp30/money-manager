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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="descstyle.css">
    <title>Home - <?php echo $website ; ?> </title>
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
        <div class="stats pd20">
            <div class="sleft">
                <p class="boldmg">INCOME</p>
                <p class="nobold">₹ <?php echo number_format( $totalincome["total"]) ; ?></p>
            </div>
            <div class="sright">
                <p class="boldmg">BALANCE</p>
                <p class="nobold">₹ 
                    <?php 
                        if ($totalincome["total"] > $jiexpenseincome["jiexpense"]) {
                            echo number_format( $totalincome["total"] -$jiexpenseincome["jiexpense"]) ;
                        }
                        elseif ($totalincome["total"] < $jiexpenseincome["jiexpense"]) {

                            echo number_format( $totalincome["total"] - $jiexpenseincome["jiexpense"]) ;
                        }
                    ?>
                </p>
            </div>
        </div>

    <!-- stat section end   -->

        <div class="txnactivity">
            <div class="txnsinner pd20">
                <h2 class="txnact"><?php echo strtoupper(date('F' )) ; ?> ACTIVITY</h2>
                <a href="<?php echo "monthreport.php?month=".date("F") ; ?>" class="viewalllink">View All</a>
            </div>
        </div>

        <div class="txnjk">
            <div class="txhjfg">


                <?php 

                    if ($sqljirun) {
                        if (mysqli_num_rows($sqljirun) >= 0) {
                            while ($row = mysqli_fetch_assoc($sqljirun)) {
                                ?>
                                    <div class="txndetail pd20">
                                        <div class="yhtg">
                                            <div class="expenselogo">
                                                <img src="
                                                <?php
                                                    if ($row["image"]) {
                                                        echo "yes";
                                                    }
                                                    else {
                                                        echo "img/expenselogo.svg";
                                                    }
                                                ?>
                                                " alt="" class="explogo">
                                            </div>
                                            <div class="loigl">
                                                <h3 class="namedesc"><?php echo $row["description"] ; ?></h3>
                                                <span class="dateon"><?php $phpdate = strtotime( $row["date"] ); echo $mysqldate = date( 'j M', $phpdate );
                                        ?></span>
                                            </div>
                                        </div>
                                        <span class="spansor">₹ <?php echo number_format($row["expense"]) ; ?></span>
                                    </div>

                                <?php
                            }
                        }
                    }
                
                    ?>


            </div>
        </div>

        <?php 
            if ($jiexpenseincome["jiexpense"]) {
            ?> <div class="totalji pd20">
                            <p class="total">Total Expense</p>
                            <p class="amounttotal">₹ <?php echo number_format($jiexpenseincome["jiexpense"]) ; ?></p>
                        </div>
                <?php
            }
            else{
                ?>
                    <div class="notfound">
                        <p class="jitext pd20">
                            <span class="kjl">No Records Found</span>
                            <br>
                            Add some transaction <a href="transact.php">here</a>
                        </p>
                    </div>
                <?php
            }
        ?>

   </div>
</div>

   


    <!-- monthly section end   -->
</div>

<!-- home page   -->

</body>

</html>