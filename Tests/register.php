<?php
require_once "configure.php";

$username = $password = $confirm_password = $phone = $email = $address = "";
$username_err = $password_err = $confirm_password_err = $phone_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['g-recaptcha-response'] != "") {
  // if(isset($_POST['submit']) && $_POST['g-recaptcha-response'] != ""){

  $secret = '6LffGwAeAAAAAIwY7iJ2gCx9vQwKh2S3YmyNwkWZ';
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
      $name = htmlspecialchars($_POST['name']);
      $account = htmlspecialchars($_POST['account']);
      $ifsc = htmlspecialchars($_POST['ifsc']);
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
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Css -->
  <link rel="stylesheet" href="../CSS/style.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>php login system</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">COMPANY NAME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../Home/index.php">Home</a>
        </li>

    </div>
  </div>
</nav>
<style>
  .h1 {
    text-align: center;
  }

  .register {
    background-color: #cc5577;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 100 60'%3E%3Cg %3E%3Crect fill='%23cc5577' width='11' height='11'/%3E%3Crect fill='%23ce5776' x='10' width='11' height='11'/%3E%3Crect fill='%23d05a76' y='10' width='11' height='11'/%3E%3Crect fill='%23d15c75' x='20' width='11' height='11'/%3E%3Crect fill='%23d35f74' x='10' y='10' width='11' height='11'/%3E%3Crect fill='%23d46174' y='20' width='11' height='11'/%3E%3Crect fill='%23d66473' x='30' width='11' height='11'/%3E%3Crect fill='%23d76673' x='20' y='10' width='11' height='11'/%3E%3Crect fill='%23d96972' x='10' y='20' width='11' height='11'/%3E%3Crect fill='%23da6c72' y='30' width='11' height='11'/%3E%3Crect fill='%23db6e71' x='40' width='11' height='11'/%3E%3Crect fill='%23dc7171' x='30' y='10' width='11' height='11'/%3E%3Crect fill='%23dd7471' x='20' y='20' width='11' height='11'/%3E%3Crect fill='%23de7671' x='10' y='30' width='11' height='11'/%3E%3Crect fill='%23df7971' y='40' width='11' height='11'/%3E%3Crect fill='%23e07c71' x='50' width='11' height='11'/%3E%3Crect fill='%23e17e71' x='40' y='10' width='11' height='11'/%3E%3Crect fill='%23e28171' x='30' y='20' width='11' height='11'/%3E%3Crect fill='%23e38471' x='20' y='30' width='11' height='11'/%3E%3Crect fill='%23e38771' x='10' y='40' width='11' height='11'/%3E%3Crect fill='%23e48972' y='50' width='11' height='11'/%3E%3Crect fill='%23e58c72' x='60' width='11' height='11'/%3E%3Crect fill='%23e58f73' x='50' y='10' width='11' height='11'/%3E%3Crect fill='%23e69173' x='40' y='20' width='11' height='11'/%3E%3Crect fill='%23e69474' x='30' y='30' width='11' height='11'/%3E%3Crect fill='%23e79775' x='20' y='40' width='11' height='11'/%3E%3Crect fill='%23e79a75' x='10' y='50' width='11' height='11'/%3E%3Crect fill='%23e89c76' x='70' width='11' height='11'/%3E%3Crect fill='%23e89f77' x='60' y='10' width='11' height='11'/%3E%3Crect fill='%23e8a278' x='50' y='20' width='11' height='11'/%3E%3Crect fill='%23e9a47a' x='40' y='30' width='11' height='11'/%3E%3Crect fill='%23e9a77b' x='30' y='40' width='11' height='11'/%3E%3Crect fill='%23e9aa7c' x='20' y='50' width='11' height='11'/%3E%3Crect fill='%23e9ac7e' x='80' width='11' height='11'/%3E%3Crect fill='%23eaaf7f' x='70' y='10' width='11' height='11'/%3E%3Crect fill='%23eab281' x='60' y='20' width='11' height='11'/%3E%3Crect fill='%23eab482' x='50' y='30' width='11' height='11'/%3E%3Crect fill='%23eab784' x='40' y='40' width='11' height='11'/%3E%3Crect fill='%23eaba86' x='30' y='50' width='11' height='11'/%3E%3Crect fill='%23ebbc88' x='90' width='11' height='11'/%3E%3Crect fill='%23ebbf8a' x='80' y='10' width='11' height='11'/%3E%3Crect fill='%23ebc18c' x='70' y='20' width='11' height='11'/%3E%3Crect fill='%23ebc48e' x='60' y='30' width='11' height='11'/%3E%3Crect fill='%23ebc790' x='50' y='40' width='11' height='11'/%3E%3Crect fill='%23ebc992' x='40' y='50' width='11' height='11'/%3E%3Crect fill='%23ebcc94' x='90' y='10' width='11' height='11'/%3E%3Crect fill='%23ebce97' x='80' y='20' width='11' height='11'/%3E%3Crect fill='%23ebd199' x='70' y='30' width='11' height='11'/%3E%3Crect fill='%23ecd39c' x='60' y='40' width='11' height='11'/%3E%3Crect fill='%23ecd69e' x='50' y='50' width='11' height='11'/%3E%3Crect fill='%23ecd8a1' x='90' y='20' width='11' height='11'/%3E%3Crect fill='%23ecdba4' x='80' y='30' width='11' height='11'/%3E%3Crect fill='%23ecdda6' x='70' y='40' width='11' height='11'/%3E%3Crect fill='%23ece0a9' x='60' y='50' width='11' height='11'/%3E%3Crect fill='%23ede2ac' x='90' y='30' width='11' height='11'/%3E%3Crect fill='%23ede4af' x='80' y='40' width='11' height='11'/%3E%3Crect fill='%23ede7b2' x='70' y='50' width='11' height='11'/%3E%3Crect fill='%23ede9b5' x='90' y='40' width='11' height='11'/%3E%3Crect fill='%23eeecb8' x='80' y='50' width='11' height='11'/%3E%3Crect fill='%23EEB' x='90' y='50' width='11' height='11'/%3E%3C/g%3E%3C/svg%3E");
    background-attachment: fixed;
    background-size: cover;
  }
</style>

<body class="register">



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



  <div class="container my-3" style="width: 1000px;">

    <h1 class="h1">REGISTER HERE!</h1>

    <div class="container" mt-4>

      <form action="../Login/register.php" method="POST">
        <h3>Don't use html special characters or white space for the fields other than address!</h3>
        <div class="mb-3">
          <label for="exampleInputphoneno." class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <p>
            <label for="signin-password" class="image-replace cd-password">Password</label>
            <input type="password" class="full-width has-padding has-border form-control" name="password" id="signin-password">
            <a href="#0" class="hide-password">Hide</a>
          <p>Password should atleast have 5 characters</p>
          </p>
        </div>

        <div class="mb-3">
          <label for="exampleInputphoneno." class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="exampleInputEmail1" aria-describedby="emailHelp">

        </div>

        <div class="mb-3">
          <label for="exampleInputphoneno." class="form-label">PHONE NUMBER</label>
          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone">
          <p>Phone number should contain 10 digits</p>
        </div>


        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
          <label for="exampleInputAddress" class="form-label">Address</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address">
          <div id="emailHelp" class="form-text">We'll never share your address with anyone else.</div>
        </div>
        <br>


        <h3>Bank Details</h3>
        <h4>Enter details carefully.</h4>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="name" id="floatingInput" placeholder="name">
          <label for="floatingInput">Name as given in your Bank account</label>
        </div>


        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="account" id="floatingInput" placeholder="name">
          <label for="floatingInput">Account Number</label>
        </div>


        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="ifsc" id="floatingInput" placeholder="name">
          <label for="floatingInput">IFSC Code</label>
        </div>


        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="refusername" id="floatingInput" value="
        <?php
        if (!empty($_GET['Ref'])) {
          echo $_GET['Ref'];
        }
        ?>
        " placeholder="name">
          <label for="floatingInput">Referer Username</label>
        </div>



        <br>

        <div class="g-recaptcha" data-sitekey="6LffGwAeAAAAAGovRiWD5ScNNBXPv4rhuAy7rcC6"></div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>

      </form>


    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
      //hide or show password
      $('.hide-password').on('click', function() {
        var $this = $(this),
          $password_field = $this.prev('input');

        ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text'): $password_field.attr('type', 'password');
        ('Hide' == $this.text()) ? $this.text('Show'): $this.text('Hide');
        //focus and move cursor to the end of input field
        $password_field.putCursorAtEnd();
      });
    </script>
</body>

</html>