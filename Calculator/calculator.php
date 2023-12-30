<?php

include('../Login/configure.php');

if (isset($_GET['submit'])) {

    $out = '';
    $amount = $_GET['amount_calculated'];

    // $result = mysqli_query($conn, "SELECT id FROM plans") or die(mysqli_error($conn));

    // $all_plans = mysqli_num_rows($result);
    // if ($all_transactions == 0) {
    //     echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>You have no transactions!</span></div>";
    // }


    $sql = "SELECT * FROM plans";

    $res =  mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // echo "$res<br>";

    function calculator($amount, $interest)
    {
        return (($interest / 100) * $amount + $amount);
    }

    function interest($calculated_amt, $amount)
    {
        return ($calculated_amt - $amount);
    }



    $i = 1;
    while ($row = mysqli_fetch_array($res)) {
        $output = '';
        $plan =  $row['name_of_plan'];
        $interest = $row['interest'];
        $tenure = $row['tenure'];
        $description = $row['description'];
        $calculated_amt = calculator($amount, $interest);
        $interest_earned = interest($calculated_amt, $amount);

        $out .= '
    <tr>
    <td scope="row">' . $i . '</td>
    <td>' . $plan . '</td>
    <td>' . $interest . ' % </td>
    <td>' . $tenure . ' months </td>
    <td>' . $description . '</td>
    <td>₹' . $calculated_amt . '</td>
    <td>₹ ' . $interest_earned . '</td>
    </tr>';
        $i++;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Calculate Plans</title>
</head>

<style>
    .bck {
        background-color: #ffffff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0' x2='0' y1='1' y2='0'%3E%3Cstop offset='0' stop-color='%230FF'/%3E%3Cstop offset='1' stop-color='%23CF6'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' x1='0' x2='0' y1='0' y2='1'%3E%3Cstop offset='0' stop-color='%23F00'/%3E%3Cstop offset='1' stop-color='%23FC0'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='%23FFF' fill-opacity='0' stroke-miterlimit='10'%3E%3Cg stroke='url(%23a)' stroke-width='2'%3E%3Cpath transform='translate(0 0)' d='M1409 581 1450.35 511 1490 581z'/%3E%3Ccircle stroke-width='4' transform='rotate(0 800 450)' cx='500' cy='100' r='40'/%3E%3Cpath transform='translate(0 0)' d='M400.86 735.5h-83.73c0-23.12 18.74-41.87 41.87-41.87S400.86 712.38 400.86 735.5z'/%3E%3C/g%3E%3Cg stroke='url(%23b)' stroke-width='4'%3E%3Cpath transform='translate(0 0)' d='M149.8 345.2 118.4 389.8 149.8 434.4 181.2 389.8z'/%3E%3Crect stroke-width='8' transform='rotate(0 1089 759)' x='1039' y='709' width='100' height='100'/%3E%3Cpath transform='rotate(0 1400 132)' d='M1426.8 132.4 1405.7 168.8 1363.7 168.8 1342.7 132.4 1363.7 96 1405.7 96z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;
    }

    .table {
        background-color: #ff9d00;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg stroke='%23000' stroke-width='66.7' stroke-opacity='0.05' %3E%3Ccircle fill='%23ff9d00' cx='0' cy='0' r='1800'/%3E%3Ccircle fill='%23fb8d17' cx='0' cy='0' r='1700'/%3E%3Ccircle fill='%23f47d24' cx='0' cy='0' r='1600'/%3E%3Ccircle fill='%23ed6e2d' cx='0' cy='0' r='1500'/%3E%3Ccircle fill='%23e35f34' cx='0' cy='0' r='1400'/%3E%3Ccircle fill='%23d85239' cx='0' cy='0' r='1300'/%3E%3Ccircle fill='%23cc453e' cx='0' cy='0' r='1200'/%3E%3Ccircle fill='%23be3941' cx='0' cy='0' r='1100'/%3E%3Ccircle fill='%23b02f43' cx='0' cy='0' r='1000'/%3E%3Ccircle fill='%23a02644' cx='0' cy='0' r='900'/%3E%3Ccircle fill='%23901e44' cx='0' cy='0' r='800'/%3E%3Ccircle fill='%23801843' cx='0' cy='0' r='700'/%3E%3Ccircle fill='%236f1341' cx='0' cy='0' r='600'/%3E%3Ccircle fill='%235e0f3d' cx='0' cy='0' r='500'/%3E%3Ccircle fill='%234e0c38' cx='0' cy='0' r='400'/%3E%3Ccircle fill='%233e0933' cx='0' cy='0' r='300'/%3E%3Ccircle fill='%232e062c' cx='0' cy='0' r='200'/%3E%3Ccircle fill='%23210024' cx='0' cy='0' r='100'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;
        color: whitesmoke;
    }
</style>


<body class="bck">
    <div class="row container my-3 g-3 align-items-center">
        <form action="" method="get">
            <div class="container-fluid my-3">

                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Enter the amount in ₹</label>
                </div>
                <div class="col-auto">
                    <input type="number" style="width: 35%;" name="amount_calculated" id="amount" class="form-control" aria-describedby="passwordHelpInline">
                </div>
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        Must be less than 10 characters long.
                    </span>
                </div>
                <div class="">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>





        <div class="">
            <?php if (isset($out)) {
                echo '
                <div class="container m-3">
                <h3>Amount - ₹' . $amount . '</h3>
                </div>
                ';

                echo
                '<div class="container-fluid my-3">
    <table class="table  table-responsive">
        
    <tr>
            <thead>
        <th scope="col">SNO.</th>
        <th scope="col">Name of plan</th>
        <th scope="col">Interest Assured</th>
        <th scope="col">Tenure of holding</th>
        <th scope="col">Plan Description</th>
        <th scope="col">Amount Assured</th>
        <th scope="col">Interest</th>
            </thead>
    </tr>
            <tbody>

    ';
                echo $out;
                echo '
            </tbody>
</table>
</div>
    ';
            } else {
                echo 'Enter the amount';
            }
            ?>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>

<!-- <script>
    $(document).ready(function() {
        let amount = $('#amount').val(this.value);
        $('#amount').on('keyup', function() {
            // on keyup event in your input field
            $.ajax({

                url: "calculate_operation.php",
                method: 'GET',
                data: {
                    amount: amount
                },
                dataType: 'number',
                success: function(response) {
                    $('.response').append(response);
                }
            }); // append values from input field
        });
    });
</script> -->

</html>