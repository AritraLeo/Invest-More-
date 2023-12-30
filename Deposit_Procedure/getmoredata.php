<?php
include('../Login/configure.php');
session_start();


if (isset($_POST['last_id'])) {

    $last_id = $_POST['last_id'];
    $out = '';
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM deposit_users WHERE username = '$username' ORDER BY id DESC LIMIT $last_id,5";
    $res =  mysqli_query($conn, $sql) or die(mysqli_error($conn));

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
    <table class="table table-dark">
                <tr>
                <td>Name</td>
                <td>Username</td>
                <td>Amount</td>
                <td>Plan Chosen</td>
                <td>Expected Date of deposit</td>
                <td>Date of Deposit</td>
                </tr>
                ' . $output . '
    </table>';
    }

    echo $out;
}
