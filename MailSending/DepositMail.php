<?php
include('../Login/configure.php');
include('smtp/PHPMailerAutoload.php');

$mail = new PHPMailer();

if (true) {

    $username = $_GET['DepData'];

    $query = " select * from users where username='" . $username . "'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $UserID = $row['id'];
        $UserName = $row['name'];
        $UserEmail = $row['email'];
    }

    $to = $UserEmail;
    $from = 'investmorefunds@gmail.com';
    $subject = 'No reply - Deposit Greetings';
    $message = 'Thank You ' . $UserName . ' for choosing our plan!
    <br>
    We are delighted to have you here.
    Hope to make you satisfied with our service, 
    <br>
    Happy investing, 
    Invest Mooreee!
    <br>
    At Invest More.
    <br>
    Regards.
    ';
    $msg = $message . '<br>' . $from;
    // $to = 'aritra056@gmail.com';


    // echo smtp_mailer('aritra056@gmail.com', 'subject', $html);
    try {
        // $mail->SMTPDebug  = 3;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "investmorefunds@gmail.com";
        $mail->Password = "ABInvestmore056@";
        $mail->SetFrom("investmorefunds@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->AddAddress($to);
        $mail->SMTPOptions = array('ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        ));
        if (!$mail->Send()) {
            echo '<script>window.location.href="../Login/login.php";</script>';
            // echo $mail->ErrorInfo;
        } else {
            echo "<div class='alert alert-success'><span class='glyphicon glyphicon-remove'>Registered Successfully Now you can Invest Moooore!</span></div>";
            echo '<script>window.location.href="../Login/login.php";</script>';
            // return 'Sent';
        }
    } catch (Exception $e) {
        $alert = '<div class="alert-error">
                <span>' . $e->getMessage() . '</span>
            </div>';
    }
} else {
    echo '<script>window.location.href="../Login/login.php";</script>';

    // echo 'Not sent';
}
