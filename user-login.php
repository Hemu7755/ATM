<?php
require_once "config.php";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $qry = mysqli_query($conn, "SELECT log_id FROM login WHERE status='1' AND BINARY username = '$username' AND BINARY password = '$password'") or die(mysqli_error($conn));

    while ($res = mysqli_fetch_object($qry)) {
        $id = $res->log_id;
    }

    session_start();
    $_SESSION['id'] = $id;
    $id = $_SESSION['id'];

    if ($id) {
        header("location:language.php");
    } else {
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login error',
                text: 'Re-login Again',
            }).then(function() {
                window.location.href = 'user-login.php';
            });
        </script>
        <?php
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>USER LOG IN</title>
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

            display: flex;
            justify-content: center;
            align-items: center;

        }
        .head{
            position: fixed;
            top: 0;
            width: 100%;
            height: 110px;
            border-radius: 0px 0px 100px 100px;
            color: rgb(220, 224, 216);
            text-align: center;
        }

        .wrapper{
            position: relative;
            width: 400px;
            height: 440px;
            top: 60px;
            background: transparent;
            border: 2px solid rgba(255,255,255,.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: height .2s ease;
        }
        .wrapper.active{
            height: 520px;
        }

        .form-box{
            width: 100%;
            padding: 40px;
        }
        .form-box.login{
            transition: transform .18s ease;
            transform: translateX(0);
        }
        .wrapper.active .form-box.login{
            transition: none;
            transform: translateX(-400px);
        }
        .form-box.register{
            position: absolute;
            transition: none;
            transform: translateX(400px);
        }
        .wrapper.active .form-box.register{
            transition: transform .20s ease;
            transform: translateX(0);
        }
        .icon-close{
            position: absolute;
            top: 0;
            right: 0;
            width: 45px;
            height: 45px;
            background: black;
            font-size: 2em;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom-left-radius: 20px;
            cursor: pointer;
            z-index: 1;
        }
        .form-box h2{
            font-size: 2em;
            color: black;
            text-align: center;
            font-weight: bold;
        }
        .input-box{
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom:2px solid black ;
            margin: 30px 0;
        }
        .input-box label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 1em;
            color: black;
            font-weight: bold;
            pointer-events: none;
        }
        .input-box input:focus~label,
        .input-box input:valid~label{
            top: -5px;
        }
        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            color: black;
            font-weight: bold;
            padding: 0 35px 0 5px;
        }
        .input-box .icon{
            position: absolute;
            right: 8px;
            font-size: 1em;
            color: black;
            line-height: 57px;
        }
        .remember-forget{
            font-size: .9em;
            color: black;
            font-weight: 500;
            margin: -15px 0 15px;
            display: flex;
            justify-content: space-between;
        }
        .remember-forget label input{
            accent-color: black;
            margin-right: 3px;
        }
        .remember-forget a{
            color: black;
            font-weight: bold;
            text-decoration: none;
        }
        .remember-forget a:hover{
            text-decoration: underline;
        }
        .btn{
            width: 100%;
            height: 45px;
            background: black;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.5em;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            font-weight: 500;
        }
        .btn:hover{
            box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
            background-color: #fff;
        }
        .login-register{
            font-size: .9em;
            color: black;
            text-align: center;
            font-weight: 500;
            margin: 25px 0 10px;
        }
        .login-register p a{
            color: black;
            text-decoration: none;
            font-weight: 600;
        }
        .login-register p a:hover{
            text-decoration: underline;
        }


        </style>
</head>
<body class="atm-background">
    <div class="head" style="background-color: black; font-family: Arial, Helvetica, sans-serif; ">
        <p class="display-2" style="top: 25px; position:relative;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
        </svg><b> HACKER BANK ATM</b></p>
    </div>
    
        <div class="wrapper">
            <a href="welcome.php"><span class="icon-close"><ion-icon name="close"></ion-icon></span></a>
            
            <div class="form-box login">
                <h2>USER LOG-IN</h2>
                <form method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="text" id="username" name="username"  required >
                        <label >Email / username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <span class="toggle-password icon" onclick="togglePasswordVisibility()"><ion-icon name="eye"></ion-icon></span>
                        <input type="password" id="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forget">
                        <label><input type="checkbox">
                        Remember me</label>
                        <a href="user-forgot.php">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn" id="submit" name="submit">Login</button>
                    <div class="login-register">
                        <p>Don't have an account? <a href="" class="register-link">Register</a></p>
                    </div>
                </form>
            </div>


            <div class="form-box register">
                <h2>Registration</h2>
                <form method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" id="user" name="user" required>
                        <label>username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="text" id="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="toggle-password icon" onclick="togglePasswordVisibility()"><ion-icon name="eye"></ion-icon></span>
                        <input type="password" id="pass" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forget">
                        <label><input type="checkbox">agree to the terms & conditions</label>
                    </div>
                    <button type="submit" class="btn" id="sub" name="sub">Register</button>
                    <div class="login-register">
                        <p>Already have an account? <a href="" class="login-link">USER login</a></p>
                    </div>
                </form>
            </div>
        </div>
    
    <script>
        const wrapper = document.querySelector('.wrapper');
        const loginlink = document.querySelector('.login-link');
        const registerlink = document.querySelector('.register-link');

        registerlink.addEventListener('click', ()=>{
            wrapper.classList.add('active');
        });
        loginlink.addEventListener('click', ()=>{
            wrapper.classList.remove('active');
        });


        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '<ion-icon name="eye-off"></ion-icon>';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '<ion-icon name="eye"></ion-icon>';
            }
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>