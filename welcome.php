<?php
require_once "config.php";
if (isset($_POST['admin'])) {
    header("Location:admin-login.php");
}
if (isset($_POST['user'])) {
    header("Location:user-login.php");
}
if (isset($_POST['info'])) {
    header("Location:info.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>ATM PROJECT</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
            }
        .atm-background {
            background-image: url('Cash.jpg');
            min-height: 100vh;
            width: 100%;
            padding: 0 10px;
            background-position: center;
            background-size: cover;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .box{
            border: 2px solid black;
            padding: 10px;
            position: relative;
            top: 100px;
            width: 100%;
            height: 500px;
            border-radius: 300px;
            background-color: black;
            opacity: 0.8;
        }
        .matter{
            position: relative;
            border-radius: 20px;
            padding: 10px;
            color: whitesmoke;
            font-style: italic;
            font-weight: bold;
            top: 40px;
            text-align: center;
        }
        .sub{
            border: 2px solid rgba(255, 255, 255, 0.5);
            position: relative;
            width: 80%;
            height: 160px;
            top: 80px;
            background-position: center;
            background-size: cover;
            /* background-color: aliceblue; */
            backdrop-filter: blur(4px);
            background-image: url('Finance-Wallpapers-Money-Different-Coins-.jpg');
            font-weight: bold;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 2px solid white;
        }
        .sub input[type="submit"] {
            width: 120px;
            margin-top: 50px;
            height: 60px;
            background-color: black;
            color: rgb(220, 224, 216);
            border: 1px solid white;
            border-radius: 5px;
            font-size: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            cursor: pointer;
            font-weight: bold;
        }
        .sub input[type="submit"]:hover {   
            background:white;
            color: black;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 1px solid black;
        }
    </style>
</head>
<body class="atm-background">
    <form method="post" class="container">
        <div class="box">
            <center>
                <div class="row matter">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <p class="display-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="color: white;" class="bi bi-github" viewBox="0 0 16 16">
                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                    </svg> WELCOME TO HACKER BANK ATM</p>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row sub" >
                    <div class="col-4">
                    <input type="submit" id="admin" name="admin" value="ADMIN LOG IN">
                    </div>
                    <div class="col-4">
                        <input type="submit" id="user" name="user" value="USER LOG IN">
                    </div>
                    <div class="col-4">
                        <input type="submit" id="info" name="info" value="MORE-INFO">
                    </div>
                </div>
            </center>
        </div>
    </form>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>