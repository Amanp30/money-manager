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
    <script src="edituser.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
        $(".changeporifle").change(function (event) {
            var x = URL.createObjectURL(event.target.files[0]);
            $("#jiimage").attr("src", x);
            console.log(event);
        });
    });
    </script>
    <title>Edit User - <?php echo $website ; ?> </title>
</head>

<div class="mainbody pd20">
<div class="lkjgg">
       <?php require 'menuji.php' ; ?>
        <div class="dexkl">

        <h1 class="editjiuser">Update User Detail</h1>

        <form action="hedituser.php" class="editu" method="post" enctype="multipart/form-data">
            <div class="ffields">
                <label>Profile</label>
                <div class="userjikiprofile">
                    <?php 
                        if ($userjidetail["image"]) {
                            ?>
                                <img src="<?php echo $userjidetail["image"] ; ?>" id="jiimage" >
                            <?php
                        }
                        else {
                            ?>
                                <img src="<?php echo "userimg/userprofile.png" ; ?>" id="jiimage" >
                            <?php
                        }
                    ?>
                    <input type="file" name="file" class="changeporifle" id="chgimg" accept="image/*" />
                </div>
            </div>

            <div class="ffields">
                <label>Name</label>
                <input type="text" name="username" value="<?php echo strtoupper($userjidetail["name"]) ; ?>">
            </div>
            
            
            <div class="ffields">
                <label>State</label>
                <select name="state" id="">
                    <option  value="">-- Select --</option>
                    <option  value="Rajasthan" <?php if($userjidetail['state'] == 'Rajasthan') { ?> selected="selected"<?php } ?>>Rajasthan</option>
                    <option  value="Haryana" <?php if($userjidetail['state'] == 'Haryana') { ?> selected="selected"<?php } ?>>Haryana</option>
                    <option  value="Punjab" <?php if($userjidetail['state'] == 'Punjab') { ?> selected="selected"<?php } ?>>Punjab</option>
                    <option  value="Gujrat" <?php if($userjidetail['state'] == 'Gujrat') { ?> selected="selected"<?php } ?>>Gujrat</option>
                    <option  value="Delhi" <?php if($userjidetail['state'] == 'Delhi') { ?> selected="selected"<?php } ?>>Delhi</option>
                    <option  value="Uttar Pardesh" <?php if($userjidetail['state'] == 'Uttar Pardesh') { ?> selected="selected"<?php } ?>>Uttar Pardesh</option>
                    <option  value="Madhya Pardesh" <?php if($userjidetail['state'] == 'Madhya Pardesh') { ?> selected="selected"<?php } ?>>Madhya Pardesh</option>
                    
                </select>
            </div>
            <div class="ffields">
                <label>Mobile No</label>
                <input type="number" name="mobileno" value="<?php echo strtoupper($userjidetail["phone"]) ; ?>">
            </div>
            
            <BUTTON type="submit" class="EDITUSER" name="update">UPDATE PROFILE</BUTTON>

        </form>
        </div>

</div>
</div>

<!-- home page   -->

</body>

</html>

<?php 

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