<?php

require_once('../Login/configure.php');
session_start();
$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $account = htmlspecialchars(trim($_POST['account']));
    $ifsc = htmlspecialchars(trim($_POST['ifsc']));

    if (empty($name) || empty($account) || empty($ifsc)) {
        echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Fields cannot be empty !</span></div>";
    } else {

        // name, account, ifsc,
        $sql = "UPDATE users set name = '" . $name . "', account='" . $account . "', ifsc='" . $ifsc . "' where username='" . $username . "'";
        $res = mysqli_query($conn, $sql) or die($conn);
        if ($res)
            echo "<div class='alert alert-success'><span class='glyphicon glyphicon-remove'>Record Updated Succesfully!</span></div>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/account.css">
    <title>Document</title>
</head>

<?php

$det = "SELECT * FROM users WHERE username = '$username'";
$res1 = mysqli_query($conn, $det);

while ($row = mysqli_fetch_assoc($res1)) {
    $nameD = $row['name'];
    $accountD = $row['account'];
    $ifscD = $row['ifsc'];
}

?>

<body>

    <div id="form-main">
        <div id="form-div">
            <form class="form" method="POST" action="" id="form1">

                <p class="name">
                    <input name="name" value="<?php echo $nameD;  ?>" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Name" id="name" />
                </p>

                <p class="email">
                    <input name="account" value="<?php echo $accountD;  ?>" type="number" class="validate[required,custom[email]] feedback-input" id="email" placeholder="Account Number" />
                </p>

                <p class="text">
                    <input type="text" name="ifsc" value="<?php echo $ifscD;  ?>" class="validate[required,length[6,300]] feedback-input" id="comment" placeholder="ifsc">
                </p>


                <div class="submit">
                    <input type="submit" name="submit" value="SUBMIT" id="button-blue" />
                    <div class="ease"></div>
                </div>
            </form>
        </div>




</body>

</html>