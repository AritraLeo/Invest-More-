<?php
include('../Login/configure.php');
session_start();
$username = $_SESSION['username'];
$q1 = "SELECT * FROM users WHERE TRIM(`username`) = '$username'";
$r1 = mysqli_query($conn, $q1);

while ($row = mysqli_fetch_assoc($r1)) {
  $email = $row['email'];
  $phone = $row['phone'];
}
// echo $email;

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
  <title>Long term Deposit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
  <div style="display:none;" id="dep_alert" class='alert alert-danger'><span class='glyphicon glyphicon-remove'>You must fill all the fields and amount Cannot be less than ₹1000!</span></div>
  <br>
  <br>
  <br>

  <div class="container" mt-4>
    <br>
    <h2>Put details here to enter the desired Plan -</h2>
    <hr>
    <br>
    <br>
    <h4>Use Same Name and Username as given before to avoid issues during transaction!</h4>
    <br>
    <!-- action = "" method = "post" -->
    <form>
      <input type="hidden" id="plan" value="<?php echo $_GET['plan_code'];  ?>">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="name" placeholder="name" required="">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" required="" name="username" id="username" placeholder="username">
        <label for="floatingPassword">Username</label>
      </div>
      <br>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" required="" name="amount" id="amount" placeholder="Amount">
        <label for="floatingPassword">Amount you want to deposit</label>
      </div>
      <br>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
        <label class="form-check-label" for="flexCheckCheckedDisabled">
          I agree to all the <a href="../Welcome/terms_and_conditions.php" style="color: blue;"><b> Terms & Conditions</b></a>
        </label>
      </div>
      <br>
      <input type="button" name="submit" class="btn btn-primary" value="Pay Now" onClick="MakePayment()">
      <!-- Pay Now</input> -->
    </form>
    <input type="email" hidden value="<?php echo $email; ?>" id="email">
    <input type="email" hidden value="<?php echo $phone;  ?>" id="phone">
  </div>

  <script>
    function MakePayment() {
      var name = $("#name").val();
      var amount = $("#amount").val();
      var username = $("#username").val();
      if (amount < 1000 || name == '' || amount == '' || username == '') {
        $('#dep_alert').css('display', 'block');
        setTimeout(function() {
          location.reload();
        }, 2000);
        // alert('Amount Cannot be less than ₹5000');
      } else {

        var email = $("#email").val();
        var phone = $("#phone").val();

        var plan_code = $("#plan").val();
        var options = {
          "key": "rzp_live_POuvPrGJa4phUV", // Enter the Key ID generated from the Dashboard
          "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
          "currency": "INR",
          "name": name,
          "description": "Invest More - Lock your funds with us and get legit interest rates!",
          "image": "../images/Invest_More_Logo/logo.png",
          "checkout": {
            "name": "Invest More"
          },
          // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
          "handler": function(response) {
            // alert(response.razorpay_payment_id);
            // alert(response.razorpay_order_id);
            // alert(response.razorpay_signature)

            // console.log(response);

            jQuery.ajax({
              type: "POST",
              url: "plan_payment.php",
              data: "pay_id=" + response.razorpay_payment_id + "&amount=" + amount + "&name=" + name + "&username=" + username + "&plan_code=" + plan_code,
              success: function(result) {
                window.location.href = "../MailSending/DepositMail.php?DepData=" + username + '';
              }
            });

          },
          "prefill": {
            "name": name,
            "email": email,
            "contact": phone
          },
          "notes": {
            "address": "Razorpay Corporate Office"
          },
          "theme": {
            "color": "#3399cc"
          }
        };

        var rzp1 = new Razorpay(options);

        rzp1.open();

      }
    }


    // else{
    //   alert("Username not same");
    // }
  </script>
</body>

</html>