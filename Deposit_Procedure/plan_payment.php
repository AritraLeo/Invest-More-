<?php

include('../Login/configure.php');

if (isset($_POST['pay_id']) && isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['username']) && isset($_POST['plan_code'])) {

    $pay_id = htmlspecialchars($_POST['pay_id']);
    $amount = htmlspecialchars($_POST['amount']);
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $plan_code = $_POST['plan_code'];

    $plan_query = "SELECT * FROM plans WHERE plan_code = '$plan_code'";
    $plan_res = mysqli_query($conn, $plan_query);



    while ($row = mysqli_fetch_assoc($plan_res)) {
        $plan_name = $row['name_of_plan'];
        $time = $row['tenure'];
    }


    // $plan_name = "SELECT name_of_plan FROM plans WHERE plan_code = '$plan'";
    // $plan = mysqli_query($conn, $plan_name);
    // $day = $plan_res * 30;



    $date = date("Y-m-d");
    $day = $time * 30;
    $on = "On";
    $newdate = date('Y-m-d', strtotime("+$day days"));
    $messagefunds = " ";
    $expected_amt_status = $on . " " . $newdate . " " . $messagefunds;

    $query = "INSERT INTO deposit_users (`name`, `username`, `plan`, `amount`, `pay_id`, `pay_status`, `expected_amt_status`) VALUES ('$name', '$username', '$plan_name', '$amount', '$pay_id', 'Success', '$expected_amt_status')";


    $finalRes = mysqli_query($conn, $query);
    if ($finalRes) {
        echo '<script>window.location.href="../MailSending/DepositMail.php?DepData=' . $username . '";</script>';
    }
}
