<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erecordz</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto',
                sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        
        .disclaimer {
    display: none;
}

        img#jiimage {
                box-shadow: 0px 0px 35px 40px #ffffff54;

    width: 80%;
    border-radius: 20px 20px 0 0;
    border: 6px solid black;
    border-bottom: 0px;
}

.testimg {
    text-align: center;
}

.topbodyji {
    background: #179a94;
}

p.jitext {
    width: 80%;
    margin: auto;
    padding: 40px 0;
    font-size: 2rem;
    line-height: 1;
    color: white;
}

.actions {
    position: fixed;
    bottom: 0;
    display: flex;
    left: 0;
    width: 100%;
    background: white;
    height: 20%;
    flex-direction: column;
}

a.loginji {
    width: 80%;
    margin: auto;
}

button {
    width: 80%;
    padding: 12px;
    margin: auto;
    background: black;
    color: white;
    border: none;
    border-radius:8px;
}

a {
    text-decoration: none;
    color: white;
}
    </style>
</head>

<body>

    <div class="topbodyji">
        <div class="textji">
            <p class="jitext">Simple Money Manager</p>
            <div class="testimg">
                <img src="img/shahrukhkhan.jpeg" alt="" id="jiimage">
            </div>
        </div>
    </div>
    <div class="actions">
       <button> <a href="login.php" class="loginji">LOGIN</a></button>
    <button><a href="register.php" class="registerji"> REGISTER</a></button>
    </div>
</body>

</html>