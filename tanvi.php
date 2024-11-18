<?php
require_once "config.php";
session_start();
$id=$_SESSION['id'];

$getuserDataQuery = mysqli_query($conn, "SELECT username, AC_no, balance, create_date_time FROM login WHERE log_id='$id'");
$userData = mysqli_fetch_assoc($getuserDataQuery);

$transactionsQuery = mysqli_query($conn, "SELECT with_draw, deposit, create_date_time FROM acc_table WHERE log_id='$id' ORDER BY create_date_time");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<title>Mini Statement</title>
<style>
.main {
    min-height: 100vh;
    width: 100%;
    background-position: center;
    background-size: cover;
    background-image:url('bg.avif');
}
.q{
    height: 30px;
}
.ab{
    background-color:black;
    color:white;
    padding:10px;
    width:90%;
    /* margin: 20px; */
    height:120px;
    border-radius: 50px;
    align-items:center;
}
.A{
    width:80px;
    height:10vh;
    border-radius: 15px;
    margin:0 auto;
    padding:5px;
}
.container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        h1, h3 {
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            margin: 0 10px;
        }

</style>
</head>
<body class="main">
    <center>
        <div class="row container q" ></div>
            <div class="row container">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="display-2 ab">
                        <img src="logo.png" class="A " alt="...">UNO BANK ATM
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </center>
</center>
<div class="container mt-5">
        <div class="row">
            <div class="row">
                <h1>Mini Statement</h1>
                <p><strong>User Information:</strong></p>
                <p>User ID: <?php echo $main; ?></p>
                <p>Name: <?php echo $userData['u_name']; ?></p>
                <p>Account Number: <?php echo $userData['acc_no']; ?></p>
                <p>Available Balance: <?php echo $userData['avl_bal']; ?></p>
                <p>Account Creation Date: <?php echo $userData['create_date_time']; ?></p>
                <hr>
                <h3>Recent Transactions:</h3>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($transaction = mysqli_fetch_assoc($transactionsQuery)) {
                            ?>
                            <tr>
                                <td><?php echo $transaction['withdrawal'] > 0 ? 'Withdrawal' : 'Deposit'; ?></td>
                                <td><?php echo $transaction['withdrawal'] > 0 ? $transaction['withdrawal'] : $transaction['deposit']; ?></td>
                                <td><?php echo $transaction['create_date_time']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form action="" method="post">
                    <input type="submit" name="exit" value="Exit" class="btn btn-primary">
                    <input type="submit" name="print" value="Print" class="btn btn-success">
                </form>
                <?php
                if (isset($_POST['exit'])) {
                    header("Location: user-menu.php");
                    exit();
                } elseif (isset($_POST['print'])) {
                    echo "<script>window.print();</script>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>