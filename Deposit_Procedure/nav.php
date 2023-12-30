<?php

session_start();
if (isset($_SESSION['username'])) {
    $link2 = 'LOGOUT';
} else {
    $link2 = '';
}


?>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" style="color:aliceblue;" href="#">INVEST MORE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" style="padding: 12px;">
                <li class="nav-item" style="padding: 12px;">
                    <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                    <button style="background: none; border: none; color:aliceblue;" class="nav-link active" TYPE="button" VALUE="Back" onClick="window.history.back();">Home</button>
                </li>
                <li class="nav-item" style="padding: 12px;">
                    <a class="nav-link active" style="color:aliceblue;" aria-current="page" href="../Login/logout.php"><?php echo $link2  ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>