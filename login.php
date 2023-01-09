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
    <title>Login - <?php echo $website ; ?> </title>
</head>

<body>
    <div class="hjnm">
        <div class="sforms">
            <div class="clogo">
                Welcome Back
            </div>

             <p class="showcondition">
                <?php 

    if (isset($_SESSION["invalidemail"])) {
        echo "Invalid email";
        session_destroy();
    }elseif (isset($_SESSION["passinco"])) {
        echo "Password is incorrect";
        session_destroy();
    }

     ?>
            </p>

            <form action="golog.php" method="post" class="formclass" autocomplete="on">
                <div class="ffields">
                    <label>E-mail</label>
                    <input type="email" name="email" id="" required >
                </div>
                <div class="ffields">
                    <label>Password</label>
                    <input type="password" name="password" id="" required>
                </div>
                <div class="sbtn">
                    <input type="submit" value="Login" name="register" id="logregi">
                </div>

                <p class="haveaccount">Don't have account <a href="register.php">Create Here</a></p>
            </form>
           
        </div>
    </div>
</body>

</html>