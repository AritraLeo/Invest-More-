<?php
require_once "configure.php";

$username = $password = $confirm_password = $phone = $email = $address = "";
$username_err = $password_err = $confirm_password_err = $phone_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['g-recaptcha-response'] != "") {
    // if(isset($_POST['submit']) && $_POST['g-recaptcha-response'] != ""){


    $secret = '6LfLwTsgAAAAAP9JdMADlk7kdwefeQdpNmw83yVJ';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if ($responseData->success) {

        // Check if username is empty
        if (empty(htmlspecialchars(trim($_POST["username"])))) {
            $username_err = "Username cannot be blank";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Username cannot be blank!</span></div>";
        } else {
            $sql = "SELECT id FROM users WHERE username = ? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set the value of param username
                $param_username = htmlspecialchars(trim($_POST['username']));

                // Try to execute this statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "<h2>This username is already taken<\h2>";
                        echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>This username is already taken!</span></div>";
                    } else {
                        $username = htmlspecialchars(trim($_POST['username']));
                    }
                } else {
                    echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Something went wrong....!</span></div>";
                }
            }
            mysqli_stmt_close($stmt);
        }




        // Check for password
        if (empty(htmlspecialchars(trim($_POST['password'])))) {
            $password_err = "Password cannot be blank";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Password cannot be blank!</span></div>";
        } elseif (strlen(trim($_POST['password'])) < 5) {
            $password_err = "Password cannot be less than 5 characters";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Password cannot be less than 5 characters!</span></div>";
        } else {
            $password = htmlspecialchars(trim($_POST['password']));
        }

        // Check for confirm password field
        if (htmlspecialchars(trim($_POST['password'])) !=  htmlspecialchars(trim($_POST['confirm_password']))) {
            $password_err = "Passwords should match";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Passwords should match!</span></div>";
        }


        //phone .......
        // Check if phone no. is empty
        if (empty(htmlspecialchars(trim($_POST["phone"])))) {
            $phone_err = "Phone number cannot be blank";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Phone number cannot be blank!</span></div>";
        } else {
            $sql = "SELECT id FROM users WHERE phone = ? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $param_phone);

                // Set the value of param username
                $param_phone = htmlspecialchars(trim($_POST['phone']));

                // Try to execute this statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $phone_err = "This Phone number is already taken";
                        echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>This Phone number is already taken!</span></div>";
                    } else {
                        $phone = htmlspecialchars(trim($_POST['phone']));
                    }
                } else {
                    echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Something went wrong....!</span></div>";
                }
            }
            mysqli_stmt_close($stmt);
        }


        //email .........
        // Check if phone no. is empty
        if (empty(htmlspecialchars(trim($_POST["email"])))) {
            $email_err = "Email id cannot be blank";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Email id cannot be blank!</span></div>";
        } else {
            $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set the value of param email
                $param_email = htmlspecialchars(trim($_POST['email']));

                // Try to execute this statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This Email id is already taken";
                        echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>This Email id is already taken!</span></div>";
                    } else {
                        $email = htmlspecialchars(trim($_POST['email']));
                    }
                } else {
                    echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Something went wrong....!</span></div>";
                }
            }
            mysqli_stmt_close($stmt);
        }

        if (!empty($_GET['Ref'])) {
            $ref = $_GET['Ref'];
        } else {
            $ref = $_POST['refusername'];
        }

        // If there were no errors, go ahead and insert into the database
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err) && empty($email_err)) {
            $address = htmlspecialchars($_POST['address']);
            $name = '';
            $account = '';
            $ifsc = '';
            $refusername = htmlspecialchars($_POST['refusername']);
            $sql = "INSERT INTO users (username, password, phone, email, address, name, account, ifsc, refererusername, dt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_phone, $param_email, $param_address, $param_name, $param_account, $param_ifsc, $param_refusername);

                // Set these parameters
                $param_username = $username;
                $param_phone = $phone;
                $param_email = $email;
                $param_address = $address;
                $param_name = $name;
                $param_account = $account;
                $param_ifsc = $ifsc;
                $param_refusername = $refusername;
                $param_password = password_hash($password, PASSWORD_BCRYPT);

                // Try to execute the query
                if (mysqli_stmt_execute($stmt)) {
                    // include('../MailSending/RegisterMail.php?GetData=');
                    echo '<script>window.location.href="../MailSending/RegisterMail.php?GetData=' . $username . '";</script>';
                    // echo '<script>window.location.href="./login.php";</script>';
                    // header("location: ../Login/login.php");
                } else {
                    $error = mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Something went wrong....!" . $error . "</span></div>";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($conn);
    }
}


?>



<!DOCTYPE html>
<html>

<head>
    <!-- Google Analytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZH1H1ZPRC1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZH1H1ZPRC1');
    </script>
    <!-- End of GA -->
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="../CSS/signup.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- Captch -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <!-- main -->
    <div class="main-w3layouts wrapper">
        <h1> SignUp </h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form action="../Login/register.php" method="post">

                    <!-- Username -->
                    <input class="text" type="text" name="username" placeholder="Username" required="">
                    <!-- Email -->
                    <input class="text email" type="email" name="email" placeholder="Email" required="">
                    <!-- Password -->
                    <input class="text email" type="password" name="password" placeholder="Password" required="">
                    <!-- Confirm Password -->
                    <input class="text w3lpass" type="password" name="confirm_password" placeholder="Confirm Password" required="">
                    <!-- Phone -->
                    <input class="text email" type="number" name="phone" placeholder="Phone Number" required="">
                    <!-- Address -->
                    <input class="text email" type="text" name="address" placeholder="Address" required="">

                    <!-- Referer username -->
                    <label for="floatingInput" style="color:aliceblue;">Referer Username</label>
                    <input class="text email" type="text" name="refusername" placeholder="Referer Username" value="<?php if (!empty($_GET['Ref'])) echo trim($_GET['Ref']); ?>">
                    <br>

                    <div class="g-recaptcha" data-sitekey="6LfLwTsgAAAAAGgQE0plFMwST4-TDso3I2zGkxyL"></div>
                    <br>

                    <input type="submit" name="submit" value="SIGNUP">
                </form>


                <p>Already have an account? <a href="login.php"> Login Now!</a></p>
                <br>
                <p>*Don't use spaces in username.
                </p>
                <br>
                <p>On succesfull account creation you'll recieve a greeting email from us!</p>
            </div>
        </div>

        <!-- //copyright -->
        <ul class="colorlib-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- //main -->
</body>

</html>