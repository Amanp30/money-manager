<?php 
session_start();

include 'connect.php';
include 'webdetail.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loger.css">
    <title>Register - <?php echo $website ; ?> </title>
</head>

<body>
    <div class="hjnm">
        <div class="sforms">
            <div class="clogo">
                Create Account
            </div>

             <p class="showcondition">
                <?php 
    
    if (isset($_SESSION["exist"])) {
        echo "Email already exist";
        session_destroy();
    }
    elseif(isset($_SESSION["inserted"])){
        echo "Account created successfully";
        session_destroy();
    }
    elseif(isset($_SESSION["passnot"])){
        echo "Password Not Matched";
        session_destroy();
    }

     ?>
            </p>

            <form action="adduser.php" method="post" class="formclass">
                <div class="ffields">
                    <label>Name</label>
                    <input type="text" name="name" id="" required>
                </div>
                <div class="ffields">
                    <label>E-mail</label>
                    <input type="email" name="email" id="" required>
                </div>
                <div class="ffields">
                    <label>Password</label>
                    <input type="password" name="password" id="" required>
                </div>
                <div class="ffields">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmpassword" id="" required>
                </div>
                <div class="sbtn">
                    <input type="submit" value="Register" name="register" id="logregi">
                </div>
                
                <p class="haveaccount">Account already created <a href="login.php">Login</a></p>
            </form>
           
        </div>
    </div>
</body>

</html>