<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: ../Login/login.php");
}

$username = $_SESSION['username'];


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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Style CSS file right here! -->
  <link rel="stylesheet" href="../CSS/style.css" />
  <link rel="stylesheet" href="../CSS/homePlan.css">
  <!-- Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <!-- Icons Bootstrap CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <!-- Animation Slide CDN -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <title>INVVESTMORE</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">

    <!-- <img src="../images/Invest More Logo/logo.png" width="40px" alt="Logo"> -->
    <a href="#" class="navbar_logo">INVVEST MORE</a>
    <div class="navbar_toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="navbar_menu">
      <a href="../Utility/UserActions.php?GetID=<?php echo $_SESSION['id']; ?>" class="navbar_link"><?php echo "Welcome " . $_SESSION['username']; ?></a>
      <a href="../Deposit_Procedure/Current_status.php" class="navbar_link">CURRENT STATUS</a>
      <a href="referal.php" class="navbar_link">REFERRALS</a>
      <?php

      require_once('../Login/configure.php');
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $acc = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($acc)) {
        $account = $row['account'];
        $name = $row['name'];
        $ifsc = $row['ifsc'];
      }
      if (!empty($account) && !empty($name) && !empty($ifsc)) {
        echo '
            <a href="#motive" class="navbar_link">MOTIVE</a>
        ';
      } else {
        echo '<a href="../Utility/addAccount.php" class="navbar_link">Add Account</a>';
      }
      ?>
      <a href="../Utility/Plans.php" class="navbar_link">PLANS</a>
      <a href="../Login/logout.php" class="navbar_link">LOGOUT</a>
    </div>
  </nav>

  <!-- HOME SECTION - hero-->

  <div class="hero">
    <div class="hero_content">
      <h1 class="animate-hero">Invest More</h1>
      <p class="animate-hero">One step solution for investing your funds</p>
      <a href="../Calculator/calculator.php" class="button animate-hero"><b>Calculate</b></a>
    </div>
  </div>

  <!-- Motive Section - Services -->
  <div class="services" id="motive">
    <div class="services_container">
      <div>
        <h1>
          <p class="topline animate-services">MOTIVE</p>
        </h1>
        <br />
        <h1 class="services_heading animate-services">
          Why we started Invest More
        </h1>
        <div class="services_features">
          <!-- 1st part -->
          <p class="services_feature animate-services">
            <i class="bi bi-check-circle-fill"></i>
            Money has pretty much got solution to every problem whether it be
            someone's marriage, hospitals bills, etc. at InvestMore we have looked into every
            such problem faced by our people, and thereby created efficient
            and lucrative plans. To shorten the fund locking period and give
            legitimate interest rates that comply with the decreasing value of
            money in this 21st Century and also considering the fact that people's trust
            is not something to be played with so we have kept the nominal
            amount to be locked as ₹ 1000.
          </p>
          <!-- 2nd part -->
          <p class="services_feature animate-services">
            <i class="bi bi-check-circle-fill"></i>
            To solve this these problems of common people, who have been
            facing such monopoly of banks and false promises of cheat funds,
            we have put together our dreams to build InvestMore so, that the
            common people especially senior citizens can get their part for
            what they put in for like 6 to 8 years.
          </p>
          <!-- 3rd part -->
          <p class="services_feature animate-services">
            <i class="bi bi-check-circle-fill"></i>
            We take the responsibility of your funds and thereby on our terms
            and conditions we have mentioned your funds will never be reduced
            only the fund locking period can be subject to change.
          </p>
          <!-- 4th part -->
          <p class="services_feature animate-services">
            <i class="bi bi-check-circle-fill"></i>
            The nominal amount is set low, for people to try our services in
            first place. Keeping in mind the common people of India.
          </p>
          <!-- 5th part -->
          <p class="services_feature animate-services">
            <i class="bi-check-circle-fill"></i>
            If you have any queries regarding plans, services, etc. Email us
            at - investmorefunds@gmail.com
          </p>
          <!-- 6th part -->
          <p class="services_feature animate-services">
            <i class="bi bi-check-circle-fill"></i>
            <b>
              “If you are born Poor its not your mistake, but if you die poor
              its your mistake” - Bill Gates.
            </b>
          </p>
        </div>
      </div>
      <!-- Motive Image -->

    </div>
  </div>
  <!-- Plans Section -  Membership -->

  <div class="memberships" id="plans">
    <h1 class="animate-membership">View Our Plans</h1>
    <p class="membership_desc animate-membership">
      Get started today by chosing a plan!
    </p>
    <div class="membership_wrapper">


      <!-- Card 1 -->
      <div class="card-basic animate-card">
        <div class="card-header header-basic">
          <h1>Short Term Basic</h1>
        </div>
        <div class="card-body">
          <p>
          <h2>2% / month</h2>
          </p>
          <div class="card-element-hidden-basic">
            <ul class="card-element-container">
              <li class="card-element">Interest - 2%</li>
              <li class="card-element">Tenure - 1 month</li>
              <!-- <li class="card-element"><button class="calculate" onclick="window.location.href='../Calculator/calculator.php'">Calculate</button></li> -->
              <li class="card-element">Get 2% of the funds you deposit after 1 month</li>
              <br>
              <a class="btn btn-basic" href="../Deposit_Procedure/Deposit_plan.php?plan_code=stb" style="text-decoration: none;">Deposit</a>
            </ul>
          </div>
        </div>
      </div>



      <!-- Card 2 -->
      <div class="card-standard animate-card">
        <div class="card-header header-standard">
          <h1>Short Term Ultra</h1>
        </div>
        <div class="card-body">
          <p>
          <h2>18% / 6 months</h2>
          </p>
          <div class="card-element-hidden-standard">
            <ul class="card-element-container">
              <li class="card-element">Interest - 18%</li>
              <li class="card-element">Tenure - 6 months</li>
              <!-- <li class="card-element"><button class="calculate" onclick="window.location.href='../Calculator/calculator.php'">Calculate</button></li> -->
              <li class="card-element">Get 18% of the funds you deposit after 6 months</li>
              <br>
              <a class="btn btn-standard" href="../Deposit_Procedure/Deposit_plan.php?plan_code=stu" style="text-decoration: none;">Deposit</a>
            </ul>
          </div>
        </div>
      </div>


    </div>
    <div class="">
      <a class="button position-absolute bottom-0 end-0" style="justify-content: left;" href="../Utility/Plans.php">View More</a>
    </div>

  </div>



  <!-- About Us Section -->
  <div class="about_us" id="about_us">
    <div class="about_us_container">
      <div>
        <h1 class="topline animate-about_us">ABOUT US</h1>
        <div class="about_us_feature">
          <p class="animate-about_us" id="about-text">
            Hi there! Welcome to Invest More.
            <br />
            One step page for managing your wealth.
            <br>
            Register now and for every ₹10000 generated by your referers on deposit you'll recieve ₹100.
            <br>
            A young team of enthusiasts to give legit
            interest rates to our people.
            <br>
            Lock or deposit your funds after registering in our website and choosing a
            plan.
            <br>
            If you have any query regarding our plans or terms and conditions
            <br />
            feel free to reach us using the mailing system given below.
            <br>
            <br>
            Invest Mooreee!
          </p>
        </div>
      </div>
      <div>
        <img src="../images/about_us_img.jpg" alt="about us image" class="about_us_img animate-img-about-us" />
      </div>


    </div>
  </div>

  <!-- Email -->
  <div class="email" id="email">
    <div class="email_content">
      <h1 class="animate-email">Contact Us</h1>
      <p class="animate-email">Ask your Queries Instantly</p>
      <form action="../MailSending/ContactMail.php" method="post" class="animate-email">
        <div class="form_wrap">
          <label for="email">
            <input type="email" name="email" placeholder="Enter your email here!" id="email" />
          </label>
          <label for="message">
            <input type="text" name="message" placeholder="Enter your messgae here!" id="message" />
          </label>
          <button class="button" type="submit" name="send_email" id="send">Send!</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="footer">
    <div class="footer_wrapper">
      <div class="footer_desc">
        <img src="../images/Invest_More_Logo/logo.png" width="70px" alt="Logo">&nbsp;
        <h1>Invest More</h1>
        <p>Here to manage your funds efficiently.</p>
        <!-- <p id="phone">52-352-523-63</p> -->
      </div>
      <div class="footer_links">
        <h2 class="footer_title">Contact Us</h2>
        <a href="#email" class="footer_link">Email - investmorefunds@gmail.com</a>
        <a href="#email" class="footer_link">Feel free to ask your queries</a>
        <a href="#email" class="footer_link">Send us a direct message!</a>
      </div>
    </div>
    <div class="footer_wrapper">
      <!-- 1st Coulmn -->
      <div class="footer_links">
        <h2 class="footer_title">Details</h2>
        <a href="../Utility/Plans.php" class="footer_link">Plans</a>
        <a href="terms_and_conditions.php" class="footer_link">T&C</a>
        <a href="privacy_policy_refund.php" class="footer_link">Privacy&Refund Policy</a>
        <a href="#motive" class="footer_link">Motive</a>
      </div>
      <!-- 2nd Coulmn -->
      <div class="footer_links">
        <h2 class="footer_title">Social Media</h2>
        <a href="https://twitter.com/InvestMoreFunds" target="blank" class="footer_link">Twitter</a>
        <a href="https://www.instagram.com/investmorefunds/" target="blank" class="footer_link">Instagram</a>
        <a href="https://www.youtube.com/channel/UC1O1_wi1OANQUQ7iDXANo4w" target="blank" class="footer_link">Youtube</a>
        <a href="https://www.facebook.com/Invest-More-106159335451141" target="blank" class="footer_link">Facebook</a>
      </div>
    </div>
  </div>
  <!-- End here! -->

  <!-- Linking AOS CDN -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 100,
    });
  </script>

  <!-- JQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!-- Gsap CDN  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <!-- [i] Scroll -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>

  <!-- linking App.js -->
  <script src="../JS/app.js"></script>
  <!-- OnClick JQuery Register -->
  <!-- <script>
    $("#deposit").on("click", function() {
      alert("Register Please to Invest Moore!");
    });
  </script> -->
</body>

</html>