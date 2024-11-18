<?php
require_once "config.php";
session_start();
$id = $_SESSION['id'];
if (!isset($id) || empty($id)) {
    header("Location: user-login.php");
    exit();
}

if (isset($_POST['Exit'])) {
    header("Location:user-menu.php");
}
if (isset($_POST['print'])) {
    echo "<script>window.print();</script>";
}
$userQuery = mysqli_query($conn, "SELECT username, AC_no, create_date_time FROM login WHERE log_id='$id'");
$userData = mysqli_fetch_assoc($userQuery);

$transactionsQuery = mysqli_query($conn, "SELECT ac_id, with_draw, deposit,avl_bal, create_date_time FROM acc_table WHERE log_id='$id' ORDER BY create_date_time DESC LIMIT 5");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>MINI STATEMENT</title>
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

        .table-container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-top: 50px;
        }

        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            color: black;
            background-color: white;
        }
        td{
            border: 2px solid black;
        }

        th {
            background-color: black;
            color: white;
            border: 2px solid white;
        }

        .row input[type="submit"] {
            width: 70%;
            height: 60px;
            margin: 20px;
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
    </style>
</head>
<body class="atm-background">
    <div class="head" style="background-color: black; font-family: Arial, Helvetica, sans-serif;">
        <p class="display-2" style="top: 25px; position:relative;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
        </svg><b> HACKER BANK ATM</b></p>
    </div>
    <center>
    <div class="table-container">
        <form action="" method="post">
            <table>
                <tr>
                    <th>S.no</th>
                    <th>Transaction ID</th>
                    <th>User ID</th>
                    <th>Account No</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Remaining Balance</th>
                    <th>Date & Time</th>
                </tr>
                <?php
                    $i = 1;
                    while ($userData && $transaction = mysqli_fetch_assoc($transactionsQuery)) {
                        ?>
                        <tr>
                            <td><?php echo $i++ ;?></td>
                            <td><?php echo $transaction['ac_id']; ?> </td>
                            <td><?php echo $userData['username']; ?></td>
                            <td><?php echo $userData['AC_no']; ?></td>
                            <td><?php echo $transaction['with_draw'] > 0 ? 'with_draw' : 'deposit'; ?></td>
                            <td><?php echo $transaction['with_draw'] > 0 ? $transaction['with_draw'] : $transaction['deposit']; ?></td>
                            <td><?php echo $transaction['avl_bal']; ?></td>
                            <td><?php echo isset($transaction['create_date_time']) ? $transaction['create_date_time'] : ''; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
            </table>
            <div class="row conatiner-fluid">
                <div class="col-4">
                    <input type="submit" name="Exit" value="Exit" class="btn">
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                    <input type="submit" name="print" value="print" class="btn">
                </div>
            </div>
        </form>
    </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
