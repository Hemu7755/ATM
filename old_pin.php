<?php
require_once "config.php";
session_start();
$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>OLD PIN</title>
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
            background-position: center;
            background-size: cover;
            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);
        }
        .head{
            height: 110px;
            border-radius: 0px 0px 100px 100px;
            color: rgb(220, 224, 216);
            text-align: center;
        }
        .abc{
            position: relative;
            width: 100%;
            top: 40px;
            background-position: center;
            background-size: cover;
            background-image: url('abundance-bank-banking-259027.jpg');
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 2px solid white;
        }
        .bc{
            margin-top: 50px;
            color: white;
            font-weight: bold;
        }
        .row input[type="password"]{
            width: 80%;
            height: 60px;
            padding: 10px;
            font-size: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            margin: 30px 0;
            border: 5px solid black;
            text-align: center;
            border-radius: 5px;
            background-color: whitesmoke;
        }
        .row input[type="button"] {
            width: 80%;
            height: 60px;
            margin: 30px 0;
            font-weight: bold;
            background-color: black;
            font-size: 15px;
            color: rgb(220, 224, 216);
            border: 2px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border-radius: 5px;
            cursor: pointer;
        }

        .row input[type="button"]:hover {
            background: gray;
            color: black;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 1px solid black;
        }  
    </style>
</head>
<body class="atm-background">
    <div class="head" style="background-color: black; font-family: Arial, Helvetica, sans-serif; ">
        <p class="display-2" style="top: 25px; position:relative;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
        </svg><b> HACKER BANK ATM</b></p>
    </div>
    <center>
        <form class="container" method="post">
            <div class="row">
                <div class=" col bc display-1">
                    Please Enter your old pin
                </div>
            </div>
            <div class="abc">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                    <input type="password" id="old" name="old" placeholder="Enter your old pin" required>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="button" class="btn" id="submit" name="submit" value="SUBMIT">
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <input type="button" class="btn" id="exit" name="exit" value="EXIT">
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="button" class="btn" id="cancel" name="cancel" value="CANCEL">
                    </div>
                </div>
            </div>
        </form>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>