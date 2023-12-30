<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Short term Deposit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
  <br>
  <br>
  <br>

  <div class="container" mt-4>
    <br>
    <h2>Put details here to enter the desired Plan -</h2>
    <hr>
    <br>
    <br>
    <h4><b>Use Same Name and Username as given before to avoid issues during transaction!</b></h4>
    <br>
    <!-- action = "" method = "post" -->
    <form>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="name" placeholder="name">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        <label for="floatingPassword">Username</label>
      </div>
      <br>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
        <label for="floatingPassword">Amount you want to deposit</label>
      </div>
      <br>
      <input type="button" name="submit" class="btn btn-primary" value="Pay Now" onClick="MakePayment()">
      <!-- Pay Now</input> -->
    </form>
  </div>

  <script>
    function MakePayment() {
      var name = $("#name").val();
      var amount = $("#amount").val();
      var username = $("#username").val();
      var options = {
        "key": "rzp_test_Wf9fRhSEBJCLND", // Enter the Key ID generated from the Dashboard
        "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": name,
        "description": "Test Transaction",
        "image": "../images/admin-user-icon-4.jpg",
        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function(response) {
          // alert(response.razorpay_payment_id);
          // alert(response.razorpay_order_id);
          // alert(response.razorpay_signature)

          // console.log(response);

          jQuery.ajax({
            type: "POST",
            url: "short_term_payment.php",
            data: "pay_id=" + response.razorpay_payment_id + "&amount=" + amount + "&name=" + name + "&username=" + username,
            success: function(result) {
              window.location.href = "success.php";
            }
          });

        },
        "prefill": {
          "name": name,
          "email": "example@example.com",
          "contact": "9999999999"
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
  </script>
</body>

</html>