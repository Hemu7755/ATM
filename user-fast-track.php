<?php
require_once "config.php";
session_start();
$id = $_SESSION['id'];
if (!isset($id) || empty($id)) {
    header("Location: user-login.php");
    exit();
}

if(isset($_POST['cancel']))
{
    header("Location:user-menu.php");
}
if (isset($_POST['Exit'])) {
    header("Location:welcome.php");
    session_destroy();
}

$userBalanceQuery = mysqli_query($conn, "SELECT balance FROM login WHERE log_id='$id'");
$userBalanceData = mysqli_fetch_assoc($userBalanceQuery);
$userBalance = $userBalanceData['balance'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Cash2'])) {
        processCashWithdrawal($conn, $id, 500, $_POST['bal2'], $userBalance);
    } elseif (isset($_POST['Cash3'])) {
        processCashWithdrawal($conn, $id, 200, $_POST['bal3'], $userBalance);
    } elseif (isset($_POST['Cash4'])) {
        processCashWithdrawal($conn, $id, 100, $_POST['bal4'], $userBalance);
    } elseif (isset($_POST['submit'])) {
    }
}

$notesQuery = mysqli_query($conn, "SELECT * FROM notes WHERE atm_id='1'");
$notesData = mysqli_fetch_assoc($notesQuery);

function processCashWithdrawal($conn, $Id, $noteValue, $noteCount, $userBalance) {
    $atmQuery = mysqli_query($conn, "SELECT atm_bal FROM atm_table WHERE atm_id='1'");
    $atmData = mysqli_fetch_assoc($atmQuery);
    $atmBalance = $atmData['atm_bal'];

    $withdrawAmount = $noteValue * $noteCount;

    if ($userBalance >= $withdrawAmount) {
        if ($atmBalance >= $withdrawAmount) {
            $newUserBalance = $userBalance - $withdrawAmount;
            mysqli_query($conn, "UPDATE login SET balance='$newUserBalance' WHERE log_id='$Id'");

            $newAtmBalance = $atmBalance - $withdrawAmount;
            mysqli_query($conn, "UPDATE atm_table SET atm_bal='$newAtmBalance' WHERE atm_id='1'");

            updateNotesTable($conn, $noteValue, $noteCount);

            mysqli_query($conn, "INSERT INTO acc_table (log_id, with_draw, deposit, avl_bal) VALUES ('$Id', '$withdrawAmount', '0','$newUserBalance')");

            echo '<script>alert("Transaction Successful!");</script>';
        } else {
            echo '<script>alert("ATM does not have sufficient funds.");</script>';
        }
    } else {
        echo '<script>alert("Insufficient funds in your account.");</script>';
    }
}

function updateNotesTable($conn, $noteValue, $noteCount) {
    $notesQuery = mysqli_query($conn, "SELECT * FROM notes WHERE atm_id='1'");
    $notesData = mysqli_fetch_assoc($notesQuery);

    $columnName = 'notes_' . $noteValue;
    $newNoteCount = $notesData[$columnName] - $noteCount;
    mysqli_query($conn, "UPDATE notes SET $columnName='$newNoteCount' WHERE atm_id='1'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>FAST_TRACK</title>
    <style>
        * {
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

        .head {
            height: 110px;
            border-radius: 0px 0px 100px 100px;
            color: rgb(220, 224, 216);
            text-align: center;
        }
        .abc{
            position: relative;
            width: 60%;
            margin: 10px 0;
            padding: 10px;
            opacity: 0.8;
            background-position: center;
            background-size: cover;
            background-image: url('Money.jpg');
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 2px solid white;
        }
        .bc{
            margin: 20px 0px;
            font-weight: bold;
            color: white;
        }
        .row input[type="submit"] {
            width: 70%;
            height: 50px;
            margin: 10px;
            font-weight: bold;
            background-color: black;
            font-size: 15px;
            color: rgb(220, 224, 216);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid white;
        }

        .row input[type="submit"]:hover {
            background: white;
            color: black;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            border: 1px solid black;
        } 
        .fast{
            border: 2px solid black;
            height:100px;
            text-align: center;
            background-color: aliceblue;
            font-size: 2em;
        }
        .fast th{
            background-color: black;
            color: aliceblue;
            border: 1px solid white;
        }
        .fast td{
            border: 1px solid black;
        }
    </style>
</head>
<body class="atm-background">
    <div class="head" style="background-color: black; font-family: Arial, Helvetica, sans-serif;">
        <p class="display-2" style="top: 25px; position:relative;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.20-.82 2.20-.82.44 1.10.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.20 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
        </svg><b> HACKER BANK ATM</b></p>
    </div>
    <center>
        <form action="" method="post" class="container-fluid track" width="80%">
            <div class="row">
                <div class="col bc display-5">
                    Please select your Option
                </div>
            </div>
            <table class="fast" width="60%">
                <tr>
                    <th>500-Notes</th>
                    <th>200-Notes</th>
                    <th>100-Notes</th>
                </tr>
                <tr>
                    <td><?php echo $notesData['notes_500']; ?></td>
                    <td><?php echo $notesData['notes_200']; ?></td>
                    <td><?php echo $notesData['notes_100']; ?></td>
                </tr>
            </table>
            
            <div class="abc">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" class="btn" id="cash2" name="Cash2" value="500">
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" class="btn" id="cash3" name="Cash3" value="200">
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" class="btn" id="cash4" name="Cash4" value="100">
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col-4">
                    <input type="submit" class="btn" id="cancel" name="cancel" value="CANCEL">
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                    <input type="submit" class="btn" id="Exit" name="Exit" value="LOG OUT">
                    </div>
                </div>
            </div>
            <input type="hidden" name="bal2" value="1">
            <input type="hidden" name="bal3" value="1">
            <input type="hidden" name="bal4" value="1">

        </form>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
