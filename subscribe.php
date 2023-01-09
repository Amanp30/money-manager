<?php
session_start() ;
include 'webdetail.php';
include 'connect.php';

if (!isset($_SESSION["logid"])) {
    header("location: login.php");
}

$user_id = $_SESSION["logid"];

if (isset($_POST["jipromocode"])) {
    $pcode = $_POST["promocode"];

    if ($pcode == "premium") {
        $sql = "INSERT INTO `subscriber`( `promocode`, `userjiid`) VALUES ('$pcode','$user_id')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            header("location: dashboard.php");
        }
    }
    else {
        ?>
            <div class="bigyes">
                No valid promocode 
                <br>
                Please Go back
            </div>
        <?php
    }
}

?>


<style>
    .bigyes {display: flex;align-items: center;justify-content: center;height: 100vw;width: 100vw;font-size: 4em;}
</style>