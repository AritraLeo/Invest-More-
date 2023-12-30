<?php require '../Deposit_Procedure/nav.php' ?>


<?php
include('../Login/configure.php');
// session_start();


$var = '';
$total_referred_amount = 0;
$referer_username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = '$referer_username'";
$acc = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($acc)) {
    $account = $row['account'];
    $ifsc = $row['ifsc'];
    $name = $row['name'];
}

$q_one = "SELECT * FROM users WHERE TRIM(`refererusername`) = '$referer_username'";
$res_one = mysqli_query($conn, $q_one) or die(mysqli_error($conn));


while ($row = mysqli_fetch_array($res_one)) {

    $var = $row['username'];
    $q_two = "SELECT SUM(amount) AS referred_amount FROM deposit_users WHERE username = '$var'";
    $res_two = mysqli_query($conn, $q_two) or die(mysqli_error($conn));


    while ($row = mysqli_fetch_assoc($res_two)) {


        $total_referred_amount += $row['referred_amount'];
    }
}

$total_referred_amount_copy = $total_referred_amount;


// echo $total_referred_amount;

// echo "<br>";



$all_refers = mysqli_num_rows($res_one);
// echo $all_refers;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">

    <title>REFERALS</title>
</head>

<style>
    .bck-referal {
        background-color: #ff9d00;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg stroke='%23000' stroke-width='66.7' stroke-opacity='0.05' %3E%3Ccircle fill='%23ff9d00' cx='0' cy='0' r='1800'/%3E%3Ccircle fill='%23fb8d17' cx='0' cy='0' r='1700'/%3E%3Ccircle fill='%23f47d24' cx='0' cy='0' r='1600'/%3E%3Ccircle fill='%23ed6e2d' cx='0' cy='0' r='1500'/%3E%3Ccircle fill='%23e35f34' cx='0' cy='0' r='1400'/%3E%3Ccircle fill='%23d85239' cx='0' cy='0' r='1300'/%3E%3Ccircle fill='%23cc453e' cx='0' cy='0' r='1200'/%3E%3Ccircle fill='%23be3941' cx='0' cy='0' r='1100'/%3E%3Ccircle fill='%23b02f43' cx='0' cy='0' r='1000'/%3E%3Ccircle fill='%23a02644' cx='0' cy='0' r='900'/%3E%3Ccircle fill='%23901e44' cx='0' cy='0' r='800'/%3E%3Ccircle fill='%23801843' cx='0' cy='0' r='700'/%3E%3Ccircle fill='%236f1341' cx='0' cy='0' r='600'/%3E%3Ccircle fill='%235e0f3d' cx='0' cy='0' r='500'/%3E%3Ccircle fill='%234e0c38' cx='0' cy='0' r='400'/%3E%3Ccircle fill='%233e0933' cx='0' cy='0' r='300'/%3E%3Ccircle fill='%232e062c' cx='0' cy='0' r='200'/%3E%3Ccircle fill='%23210024' cx='0' cy='0' r='100'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;
    }
</style>




<body class="bck-referal">



    <div>
        <div class="plans-more-wrapper">
            <div class="container my-3">
                <div class="card text-center">
                    <div class="card-header">
                        <h1>REFERALS</h1>
                    </div>
                    <div class="card-body">
                        <div class="container mt-3">

                            <div class="container mt -3">

                                <!-- Text Message to copy -->
                                <!-- The text field -->
                                <p id="myInput" title="Copy Text">
                                    Hi! Join Invest More today I have registered and I am enjoying their services.
                                    <br>
                                    Register and be a part of their great referal program where you'll get ₹1000
                                    <br>
                                    for every ₹10000 generated when your referers choose a plan. Register Now and Invest Mooree!
                                    <br>
                                    <br>
                                    <a style="color:blue;" href="../Login/register.php?Ref=<?php echo $_SESSION['username'];  ?>">
                                        http://investmorefunds.in/Login/register.php?Ref=<?php echo $_SESSION['username'];  ?></a>
                                </p>
                                <button class="button" onclick="copyToClipboard()">Copy text</button>
                            </div>
                            <h5 class="card-title">
                                <?php if ($all_refers == 0) {

                                    echo '<div class="container my-3">
                                    
                                    <div class="alert alert-danger"><span class="glyphicon glyphicon-remove">Your friends are not loyal to you! They have not registered yet :( <br>
                                    Anyways donot lose hope and keep referring :)</span></div>
                                    </div>
                                    
                                    ';
                                } else {
                                    echo '<div class="row">
            <p><h3>Total users joined using your link:  <b>' . $all_refers . '</b></h3><br></p>
            <br>
            </div>';

                                    if ($total_referred_amount_copy >= 10000) {
                                        $amount_deserved = floor($total_referred_amount_copy / 10000) * 100;

                                        if (empty($account) || empty($ifsc) || empty($name)) {
                                            echo "
                                            <div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Plz add your bank account to recieve the amount. !<br>
                                            You've generated through referrals!
                </span></div>";
                                        }

                                        echo '<div class="row">
            <p><h3>Amount that will be credited to your account: <b> ₹ ' . $amount_deserved . '</b></h3><br></p>
            <br>
            </div>';

                                        echo '<div class="row">
            <p><h3>Amount Generated through Refers: <b> ₹ ' . $total_referred_amount . '</b></h3><br></p>
            <br>
            </div>';
                                    } else {
                                        echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Sorry to say but your referred friends haven't locked ₹ 10,000 in all!<br>
                Anyways don't lose hope and keep referring :)
                </span></div>";
                                    }
                                }
                                ?>

                        </div>
                    </div>
                </div>






                <!-- Total referred -->
                <div class="container">
                    <?php
                    //         if ($all_refers == 0) {

                    //         } else {
                    //             echo '<div class="row">
                    // <p><h3>Total Refers:  <b>' . $all_refers . '</b></h3><br></p>
                    // <br>
                    // </div>';

                    //             if ($total_referred_amount_copy >= 10000) {
                    //                 $amount_deserved = floor($total_referred_amount_copy / 10000) * 1000;
                    //                 echo '<div class="row">
                    // <p><h3>Total Refers:  <b> Rs.' . $amount_deserved . '</b></h3><br></p>
                    // <br>
                    // </div>';

                    //                 echo '<div class="row">
                    // <p><h3>Total Refers:  <b> Rs.' . $total_referred_amount . '</b></h3><br></p>
                    // <br>
                    // </div>';
                    //             } else {
                    //                 echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>Sorry to say but your referred friends haven't locked Rs.10,000 in all!<br>
                    //     Anyways don't lose hope and keep referring :)
                    //     </span></div>";
                    //             }
                    //         }
                    ?>

                </div>



                <!-- <div>
                    <div class="plans-more-wrapper">
                        <div class="container my-3">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h1>REFERALS</h1>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"> NAME OF PLAN</h5>
                                    <p class="card-text"> INTEREST </p>
                                    <p class="card-text"> TIME SPAN </p>
                                    <p class="card-text"> DESC </p>
                                    <a href="#" class="btn btn-primary">Deposit</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->




            </div>
            <script src="../JS/CopyToClipboard.js"></script>
            <style>
                .tooltip {
                    position: relative;
                    display: inline-block;
                }

                .tooltip .tooltiptext {
                    visibility: hidden;
                    width: 140px;
                    background-color: #555;
                    color: #fff;
                    text-align: center;
                    border-radius: 6px;
                    padding: 5px;
                    position: absolute;
                    z-index: 1;
                    bottom: 150%;
                    left: 50%;
                    margin-left: -75px;
                    opacity: 0;
                    transition: opacity 0.3s;
                }

                .tooltip .tooltiptext::after {
                    content: "";
                    position: absolute;
                    top: 100%;
                    left: 50%;
                    margin-left: -5px;
                    border-width: 5px;
                    border-style: solid;
                    border-color: #555 transparent transparent transparent;
                }

                .tooltip:hover .tooltiptext {
                    visibility: visible;
                    opacity: 1;
                }
            </style>
</body>

</html>