<?php
include('smtp/PHPMailerAutoload.php');
include('../Login/configure.php');


$mail = new PHPMailer();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $from = $_POST['email'];
    $subject = 'Queries';
    $message = htmlspecialchars($_POST['message']);
    $msg = $message . '<br>' . $from;
    $to = 'aritrabinance056@gmail.com';


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
            $sql = "INSERT INTO contact (email, msg, dt) VALUES ('$from', '$message', current_timestamp())";
            $res = mysqli_query($conn, $sql);

            session_start();
            if (isset($_SESSION['username'])) {
                $_SESSION["loggedin"] = true;
                echo '<script>window.location.href="../Welcome/welcome.php"</script>';
            } else {
                echo '<script>window.location.href="../Home/index.php"</script>';
            }
            // echo $mail->ErrorInfo;
        } else {
            // return 'Sent';
            session_start();
            if (isset($_SESSION['username'])) {
                $_SESSION["loggedin"] = true;
                echo '<script>window.location.href="../Welcome/welcome.php"</script>';
            } else {
                echo '<script>window.location.href="../Home/index.php"</script>';
            }
        }
    } catch (Exception $e) {
        $sql = "INSERT INTO contact (email, msg, dt) VALUES ('$from', '$message', current_timestamp())";
        $res = mysqli_query($conn, $sql);
        // $alert = '<div class="alert-error">
        //         <span>' . $e->getMessage() . '</span>
        //     </div>';
    }
} else {
    $sql = "INSERT INTO contact (email, msg, dt) VALUES ('$from', '$message', current_timestamp())";
    $res = mysqli_query($conn, $sql);
    // echo 'Not sent';
}
