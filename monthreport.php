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


$start = strtotime('first day of this month');
$monthname = $_GET["month"];

$startdate =  date('Y-m-d', strtotime($monthname, $start));
$lastdate =  date('Y-m-t', strtotime($monthname, $start));

$monthreport = "SELECT * from `exp` WHERE `date` between '$startdate' and '$lastdate' and user_id = '$user_id' order by date desc;";
$month = mysqli_query($con, $monthreport);

$incomejireport = "SELECT * FROM `income` WHERE `date` between '$startdate' and '$lastdate' and users_id = '$user_id' order by date desc;";
$incomeji = mysqli_query($con, $incomejireport);

$total = "SELECT SUM(income) as total FROM `income` WHERE `date` between '$startdate' and '$lastdate' and users_id = '$user_id' order by date desc ;";
$totalrun = mysqli_query($con, $total);
$totalincome = mysqli_fetch_assoc($totalrun);

$jiexpense = "SELECT SUM(expense) as jiexpense from `exp` WHERE date between '$startdate' and '$lastdate' AND user_id = '$user_id';";
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
    <title> <?php echo $monthname . " Report - " . $website ; ?> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#c2").hide();
            $("#c1").show();
            $("#hide").click(function () {
                $("#c2").hide();
                $("#c1").show();
                $("#hide").addClass("jishow");
                $("#show").removeClass("jishow");
            });
            $("#show").click(function () {
                $("#c2").show();
                $("#c1").hide();
                 $("#show").addClass("jishow");
                $("#hide").removeClass("jishow");
            });
        });
    </script>
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
        <div class="wallet">
            <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35px"
                    height="35px">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M288 256C288 273.7 273.7 288 256 288C238.3 288 224 273.7 224 256V32C224 14.33 238.3 0 256 0C273.7 0 288 14.33 288 32V256zM80 256C80 353.2 158.8 432 256 432C353.2 432 432 353.2 432 256C432 201.6 407.3 152.9 368.5 120.6C354.9 109.3 353 89.13 364.3 75.54C375.6 61.95 395.8 60.1 409.4 71.4C462.2 115.4 496 181.8 496 255.1C496 388.5 388.5 496 256 496C123.5 496 16 388.5 16 255.1C16 181.8 49.75 115.4 102.6 71.4C116.2 60.1 136.4 61.95 147.7 75.54C158.1 89.13 157.1 109.3 143.5 120.6C104.7 152.9 80 201.6 80 256z" />
                </svg></a>
        </div>
    </div>


    <div class="lkjgg">

<?php require 'menuji.php' ; ?>

            <div class="dexkl">

                    <div class="txnactivity">
                        <div class="txnsinner pd20">
                            <h2 class="txnact"><?php echo strtoupper(date('F', strtotime($startdate))) ; ?> ACTIVITY</h2>
                        </div>
                    </div>

                    <div class="epofgt">
                        <div class="slectionji">
                            <div id="hide" class="jishow">Income</div>
                            <div id="show">Expense</div>
                        </div>
                        <div class="dataji">
                            <div id="c1">
                                <!-- income section start   -->
                                <?php 

                                    if ($incomeji) {
                                        if (mysqli_num_rows($incomeji) >= 0) {
                                            while ($incomestmt = mysqli_fetch_assoc($incomeji)) {
                                                ?>
                                                    <div class="txndetail pd20">
                                                        <div class="yhtg">
                                                            <div class="expenselogo">
                                                                <img src="
                                                                <?php echo "img/cashin.svg";
                                                                ?> " alt="" class="explogo">
                                                            </div>
                                                            <div class="loigl">
                                                                <h3 class="namedesc"><?php echo $incomestmt["description"] ; ?></h3>
                                                                <span class="dateon"><?php $phpdate = strtotime( $incomestmt["date"] ); echo $mysqldate = date( 'j M', $phpdate );
                                                                            ?></span>
                                                            </div>
                                                        </div>
                                                        <span class="spansor">₹ <?php echo number_format( $incomestmt["income"] ) ;?></span>

                                                    </div>

                                                <?php
                                            }
                                        }
                                    }

                                ?>

                        <?php 
                        if ($totalincome["total"] ) {
                            ?>
                                <div class="totalji pd20">
                                    <p class="total">Total Income</p>
                                    <p class="amounttotal">₹ <?php echo number_format( $totalincome["total"]) ; ?></p>
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


            <div id="c2">
                <!-- Expense section start   -->

                            <?php 

                                if ($month) {
                                    if (mysqli_num_rows($month) >= 0) {
                                        while ($row = mysqli_fetch_assoc($month)) {
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
                                                            ?> " alt="" class="explogo">
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

                        <?php 
                        if ($jiexpenseincome["jiexpense"] ) {
                            ?>
                                <div class="totalji pd20">
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
                    </div>
            </div>

    <!-- monthly section end   -->
</div>
</div>

<!-- home page   -->

</body>

</html>