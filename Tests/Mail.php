<?php

if (isset($_GET['submit'])) {
    # code...
    // the message
    $msg = "First line of text\nSecond line of text";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail("aritra056@gmail.com", "My subject", $msg);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mail</title>
</head>

<body>
    <form action="" method="get">
        <button name="submit" type="submit">Mail</button>
    </form>
</body>

</html>