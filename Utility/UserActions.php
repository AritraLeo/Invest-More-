<?php

require_once("../Login/configure.php");
$id = $_GET['GetID'];
$query = " select * from users where id='" . $id . "'";
$result = mysqli_query($conn, $query) or die('false');

while ($row = mysqli_fetch_assoc($result)) {
    $id_new = $row['id'];
    $name = $row['name'];
    $password = $row['password'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $account = $row['account'];
    $ifsc = $row['ifsc'];
}

?>

<!--12345 - $2y$10$6FBd/soJsaG/Qm8thq/kIOUS.qsaWs7kUnbUQPS0FvigcI7ZM0MJW -->

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
    <title>Document</title>
</head>

<style>
    .constellation {
        background-color: #330033;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23404' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23505'%3E%3Ccircle cx='769' cy='229' r='9'/%3E%3Ccircle cx='539' cy='269' r='9'/%3E%3Ccircle cx='603' cy='493' r='9'/%3E%3Ccircle cx='731' cy='737' r='9'/%3E%3Ccircle cx='520' cy='660' r='9'/%3E%3Ccircle cx='309' cy='538' r='9'/%3E%3Ccircle cx='295' cy='764' r='9'/%3E%3Ccircle cx='40' cy='599' r='9'/%3E%3Ccircle cx='102' cy='382' r='9'/%3E%3Ccircle cx='127' cy='80' r='9'/%3E%3Ccircle cx='370' cy='105' r='9'/%3E%3Ccircle cx='578' cy='42' r='9'/%3E%3Ccircle cx='237' cy='261' r='9'/%3E%3Ccircle cx='390' cy='382' r='9'/%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<body class="constellation">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h3 class="bg-success text-white text-center py-3"> Edit Details </h3>
                    </div>
                    <div class="card-body">

                        <form action="./PHP-Crud-Site/update.php?ID=<?php echo $id ?>" method="post">

                            <input type="text" class="form-control mb-2" placeholder="Name" name="name" value="<?php echo $name  ?>">

                            <input type="password" class="form-control mb-2" placeholder="Password" name="password" value="">

                            <input type="password" class="form-control mb-2" placeholder="Confirm Password" name="cpassword" value="">

                            <input type="text" class="form-control mb-2" placeholder="Phone No." name="phone" value="<?php echo $phone  ?>">

                            <input type="text" class="form-control mb-2" placeholder="Email" name="email" value="<?php echo $email  ?>">

                            <input type="text" class="form-control mb-2" placeholder="Address" name="address" value="<?php echo $address  ?>">

                            <input type="text" class="form-control mb-2" placeholder="Account No." name="account" value="<?php echo $account  ?>">

                            <input type="text" class="form-control mb-2" placeholder="IFSC" name="ifsc" value="<?php echo $ifsc  ?>">

                            <div class="my-3">
                                <button class="btn btn-primary" name="update">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>