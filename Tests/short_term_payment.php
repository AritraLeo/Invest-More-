<?php

include('../Login/configure.php');


if (isset($_POST['pay_id']) && isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['username'])) {

    $pay_id = htmlspecialchars($_POST['pay_id']);
    $amount = htmlspecialchars($_POST['amount']);
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $plan = "short term";

    $date = date("Y-m-d");
    $day = 182;
    $on = "On";
    $newdate = date('Y-m-d', strtotime("+$day days"));
    $messagefunds = "your funds are expected to be deposited to your account with interest";
    $expected_amt_status = $on . " " . $newdate . " " . $messagefunds;
    // echo "today is:" . $date;
    // echo "<br> and after 5 days is :" . $newdate;


    // Username check!
    // $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");
    // if(mysqli_num_rows($select)) {
    //     echo('Username already exists');
    //     // exit('This username already exists');
    // }


    $query = "INSERT INTO deposit_users (`name`, `username`, `plan`, `amount`, `pay_id`, `pay_status`, `expected_amt_status`) VALUES ('$name', '$username', '$plan', '$amount', '$pay_id', 'Success', '$expected_amt_status')";


    mysqli_query($conn, $query);
}
