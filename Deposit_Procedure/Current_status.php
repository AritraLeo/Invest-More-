<?php require 'nav.php' ?>



<?php

// include('config_deposit.php');
include('../Login/configure.php');
// session_start();


$output = '';
$out = '';
$total_amount_deposited = 0;

$username = $_SESSION['username'];

// Num rows for all plans
$sql = "SELECT * FROM deposit_users WHERE username = '$username'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Total amount deposited
$q_one = "SELECT * FROM users WHERE TRIM(`username`) = '$username'";
$res_one = mysqli_query($conn, $q_one) or die(mysqli_error($conn));

$q_two = "SELECT SUM(amount) AS total_deposit FROM deposit_users WHERE TRIM(`username`) = '$username'";
$res_two = mysqli_query($conn, $q_two) or die(mysqli_error($conn));


while ($row1 = mysqli_fetch_assoc($res_two)) {
    $total_amount_deposited += $row1['total_deposit'];
}



$all_transactions = mysqli_num_rows($result);
if ($all_transactions == 0) {
    echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'>You have no transactions!</span></div>";
}


$sql = "SELECT * FROM deposit_users WHERE username = '$username' ORDER BY id DESC LIMIT 0,5";

$res =  mysqli_query($conn, $sql) or die(mysqli_error($conn));
// echo "$res<br>";



while ($row = mysqli_fetch_array($res)) {


    $output = '';
    $user_id = $row['pay_id'];
    $output .= '<tr><td>' . $row['name'] . '</td>';
    $output .= '<td>' . $row['username'] . '</td>';
    $output .= '<td>' . $row['amount'] . '</td>';
    $output .= '<td>' . $row['plan'] . '</td>';
    $output .= '<td>' . $row['expected_amt_status'] . '</td>';
    $output .= '<td>' . $row['dt'] . '</td></tr>';



    $out .= '<div class="alert-secondary p-2 rounded-top">
    <form method = "post">
    <strong>Pay ID: ' . $user_id . '</strong>
    <input type="hidden" name="username" value="' . $row['username'] . '">
    
    </form>
    </div>
    <table class="table table-dark table responsive">
                <tr>
                <td>Name</td>
                <td>Username</td>
                <td>Amount</td>
                <td>Plan Chosen</td>
                <td class="w-25">Expected Date of Deposit</td>
                <td>Date of Deposit</td>
                </tr>
                ' . $output . '
    </table>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Current Status</title>
</head>

<style>
    .back {
        background-color: #cc5577;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 100 60'%3E%3Cg %3E%3Crect fill='%23cc5577' width='11' height='11'/%3E%3Crect fill='%23ce5776' x='10' width='11' height='11'/%3E%3Crect fill='%23d05a76' y='10' width='11' height='11'/%3E%3Crect fill='%23d15c75' x='20' width='11' height='11'/%3E%3Crect fill='%23d35f74' x='10' y='10' width='11' height='11'/%3E%3Crect fill='%23d46174' y='20' width='11' height='11'/%3E%3Crect fill='%23d66473' x='30' width='11' height='11'/%3E%3Crect fill='%23d76673' x='20' y='10' width='11' height='11'/%3E%3Crect fill='%23d96972' x='10' y='20' width='11' height='11'/%3E%3Crect fill='%23da6c72' y='30' width='11' height='11'/%3E%3Crect fill='%23db6e71' x='40' width='11' height='11'/%3E%3Crect fill='%23dc7171' x='30' y='10' width='11' height='11'/%3E%3Crect fill='%23dd7471' x='20' y='20' width='11' height='11'/%3E%3Crect fill='%23de7671' x='10' y='30' width='11' height='11'/%3E%3Crect fill='%23df7971' y='40' width='11' height='11'/%3E%3Crect fill='%23e07c71' x='50' width='11' height='11'/%3E%3Crect fill='%23e17e71' x='40' y='10' width='11' height='11'/%3E%3Crect fill='%23e28171' x='30' y='20' width='11' height='11'/%3E%3Crect fill='%23e38471' x='20' y='30' width='11' height='11'/%3E%3Crect fill='%23e38771' x='10' y='40' width='11' height='11'/%3E%3Crect fill='%23e48972' y='50' width='11' height='11'/%3E%3Crect fill='%23e58c72' x='60' width='11' height='11'/%3E%3Crect fill='%23e58f73' x='50' y='10' width='11' height='11'/%3E%3Crect fill='%23e69173' x='40' y='20' width='11' height='11'/%3E%3Crect fill='%23e69474' x='30' y='30' width='11' height='11'/%3E%3Crect fill='%23e79775' x='20' y='40' width='11' height='11'/%3E%3Crect fill='%23e79a75' x='10' y='50' width='11' height='11'/%3E%3Crect fill='%23e89c76' x='70' width='11' height='11'/%3E%3Crect fill='%23e89f77' x='60' y='10' width='11' height='11'/%3E%3Crect fill='%23e8a278' x='50' y='20' width='11' height='11'/%3E%3Crect fill='%23e9a47a' x='40' y='30' width='11' height='11'/%3E%3Crect fill='%23e9a77b' x='30' y='40' width='11' height='11'/%3E%3Crect fill='%23e9aa7c' x='20' y='50' width='11' height='11'/%3E%3Crect fill='%23e9ac7e' x='80' width='11' height='11'/%3E%3Crect fill='%23eaaf7f' x='70' y='10' width='11' height='11'/%3E%3Crect fill='%23eab281' x='60' y='20' width='11' height='11'/%3E%3Crect fill='%23eab482' x='50' y='30' width='11' height='11'/%3E%3Crect fill='%23eab784' x='40' y='40' width='11' height='11'/%3E%3Crect fill='%23eaba86' x='30' y='50' width='11' height='11'/%3E%3Crect fill='%23ebbc88' x='90' width='11' height='11'/%3E%3Crect fill='%23ebbf8a' x='80' y='10' width='11' height='11'/%3E%3Crect fill='%23ebc18c' x='70' y='20' width='11' height='11'/%3E%3Crect fill='%23ebc48e' x='60' y='30' width='11' height='11'/%3E%3Crect fill='%23ebc790' x='50' y='40' width='11' height='11'/%3E%3Crect fill='%23ebc992' x='40' y='50' width='11' height='11'/%3E%3Crect fill='%23ebcc94' x='90' y='10' width='11' height='11'/%3E%3Crect fill='%23ebce97' x='80' y='20' width='11' height='11'/%3E%3Crect fill='%23ebd199' x='70' y='30' width='11' height='11'/%3E%3Crect fill='%23ecd39c' x='60' y='40' width='11' height='11'/%3E%3Crect fill='%23ecd69e' x='50' y='50' width='11' height='11'/%3E%3Crect fill='%23ecd8a1' x='90' y='20' width='11' height='11'/%3E%3Crect fill='%23ecdba4' x='80' y='30' width='11' height='11'/%3E%3Crect fill='%23ecdda6' x='70' y='40' width='11' height='11'/%3E%3Crect fill='%23ece0a9' x='60' y='50' width='11' height='11'/%3E%3Crect fill='%23ede2ac' x='90' y='30' width='11' height='11'/%3E%3Crect fill='%23ede4af' x='80' y='40' width='11' height='11'/%3E%3Crect fill='%23ede7b2' x='70' y='50' width='11' height='11'/%3E%3Crect fill='%23ede9b5' x='90' y='40' width='11' height='11'/%3E%3Crect fill='%23eeecb8' x='80' y='50' width='11' height='11'/%3E%3Crect fill='%23EEB' x='90' y='50' width='11' height='11'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<body class="back">

    <div class="container mt-3">

        <div class="row">
            <h3>Total Plans: <?php echo "$all_transactions<br>";   ?></h3>
            <h3>Total Amount: <?php echo "$total_amount_deposited<br>";   ?></h3>
            <!-- <h3>Total Plans: <?php //echo "$all_transactions<br>";   
                                    ?></h3> -->
            <br>
            <div class="details p-3">

                <?php

                echo $out;
                ?>
                <div id="data"></div>
                <div id="loading"></div>
                <div id="order_info" class="text-primary"></div>
                <form method="POST">
                    <button type="button" name="load_more" id="load_more" class="btn btn-sm btn-primary">
                        Load More...
                    </button>
                    <input type="hidden" name="" id="total_orders" value="<?php echo $all_transactions; ?>">
                </form>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    var last_id = 5;
    var total_orders = $('#total_orders').val();

    if (total_orders == 0) {
        $('#load_more').hide();
        $('#order_info').css("display", "block");
        window.setTimeout(function() {
            $('#order_info').html("Please Invest-Mooore!");
        }, 100);
    } else {
        $('#load_more').click(function() {




            $.ajax({
                url: "getmoredata.php",
                method: "POST",
                data: {
                    last_id: last_id
                },
                dataType: "text",
                success: function(data) {
                    $('#load_more').hide();
                    $('#loading').html("<img src='../images/loading.gif' height='30' width='47'>");
                    window.setTimeout(function() {
                        $(data).appendTo('#data').hide().fadeIn(600);
                        $('#loading').html('');
                        $('#load_more').show();

                    }, 600);

                    last_id += 5;
                    if (last_id > total_orders) {
                        $('#load_more').css("visibility", "hidden");
                        $('#order_info').css("display", "block");
                        window.setTimeout(function() {
                            $('#order_info').html("That's all your transactions");
                        }, 1000);
                    }
                }
            });
        })
    };
</script>


</html>