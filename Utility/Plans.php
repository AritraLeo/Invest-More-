<?php

require('../Login/configure.php');

$sql = "SELECT * FROM plans";
$sql2 = "ORDER BY id DESC WHERE featured = 'true'";
$result = mysqli_query($conn, $sql) or die('Error');

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
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Linking Style sheet -->
    <link rel="stylesheet" href="../CSS/plans.css">
    <title>Document</title>
</head>

<?php include('../Deposit_Procedure/nav.php');    ?>

<?php

// session_start();
if (isset($_SESSION['username']))
    $url =  '../Deposit_Procedure/Deposit_plan.php';
else
    $url =  '#'; ?>

<body class="plan">

    <h1>Our Plans</h1>
    <h1>Choose a Plan and get started</h1>


    <div class="container my-3 d-flex justify-content-center">
        <ul class="product-plans ">

            <?php

            while ($row = mysqli_fetch_assoc($result)) {

                $nameOfPlan = $row['name_of_plan'];
                $plan_code = $row['plan_code'];
                $Interest = $row['interest'];
                $Tenure = $row['tenure'];
                $description = $row['description'];
                $color = $row['accent_color'];
                $featured = $row['featured'];
            ?>

                <li class="product-plan card-bck" style="--accent-color: <?php echo $color  ?>;">
                    <div class="title"><?php echo $nameOfPlan ?></div>
                    <div class="price"><?php
                                        if ($featured == 0) {
                                            echo 'Check Out this plan';
                                        } else {
                                            echo 'Featured';
                                        }

                                        ?></div>
                    <ul class="features">
                        <li class="check">Timespan - <?php echo $Tenure ?> <?php if ($Tenure == 1) echo 'month';
                                                                            else echo 'months';  ?>
                        </li>
                        <li class="check">Interest - <?php echo $Interest ?> %</li>
                        <li class="check"><button class="calculate" onclick="window.location.href='../Calculator/calculator.php'">Calculate</button></li>
                        <li class="check"><?php echo $description ?></li>

                    </ul>
                    <a class="btn" style="text-decoration: none; color:azure;" href=<?php echo $url . '?plan_code=' . $plan_code ?> btn-primary">Deposit</a>
                </li>

            <?php
            }

            ?>
        </ul>
    </div>

</body>

</html>