<?php
include 'components/secondaryNav.php';
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order|Book Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="shortcut icon" href="assets/logo/logo.jpg" type="image/x-icon">
  </head>
  <body>
    <div class="bg-gray-100">
        <!-- secondary nav -->
      <?php secondaryNav("order","bell") ?>
      <!-- credit card div -->
      <!-- if user select payment method reflect this image here also do for name and card no -->
      <div class="sm:grid grid-cols-2 lg:flex lg:items-center lg:justify-around">
      <div class="bg-black p-4 m-4 rounded-xl shadow lg:w-96">
        <h2 class="font-semibold text-white capitalize text-lg mb-4">
          credit card
        </h2>
        <p class="card-number text-white">3541 5575402 33006</p>
        <div class="flex items-center justify-between">
          <p class="card-holder capitalize text-white">iron man</p>
          <img
            class="card-img w-14 h-10 rounded object-contain bg-white"
            src="assets/CreditCardImges/upi.png"
            alt=""
          />
        </div>
        <p class="expiry-date text-white">02/24</p>
      </div>

      <!-- address -->
      <div class="p-4 m-4 bg-white rounded-lg shadow">
        <h3 class="address capitalize font-semibold text-lg">address</h3>

        <!-- user current address -->
        <!-- if user already fill the address then -->
        <div class="shadow p-4 rounded-lg my-2">
          <h3 class="font-medium capitalize">iron man</h3>
          <p class="capitalize font-normal text-sm line-clamp-2">
            at post maharashtra ,pune,baramati ,near tc college baramati.
          </p>
          <div class="flex items-center justify-between">
            <p></p>
            <a
              href="#profile"
              class="block cursor-default sm:cursor-pointer capitalize w-fit text-sm mt-2 shadow bg-gray-200 focus:bg-gray-100 transition rounded p-2"
              >change address</a
            >
          </div>
        </div>
      </div>
    </div><!-- changes -->
    <!-- payment method-->
      <!-- changes -->
      <div class="sm:grid place-items-center ">
      <div class="p-4 m-4 rounded-lg bg-white shadow max-w-2xl sm:w-[90%]">
        <h3 class="font-semibold capitalize text-lg">payment method</h3>
        <div class="flex items-center gap-2 mt-2">
          <label
            for="upi"
            class="pmethod border-2 border-black shadow rounded transition sm:cursor-pointer"
          >
            <img
              class="rounded w-14 h-10"
              src="assets/CreditCardImges/upi.png"
              alt=""
            />
            <input class="hidden" type="radio" id="upi" name="payment-method" />
          </label>
          <label
            for="master"
            class="pmethod border-2 border-neutral-300 hover:border-black shadow rounded transition sm:cursor-pointer"
          >
            <img
              class="rounded w-14 h-10"
              src="assets/CreditCardImges/masterCard.png"
              alt=""
            />
            <input
              class="hidden"
              type="radio"
              id="master"
              name="payment-method"
            />
          </label>
          <label
            for="visa"
            class="pmethod border-2 border-neutral-300 hover:border-black shadow rounded transition sm:cursor-pointer"
          >
            <img
              class="rounded w-14 h-10"
              src="assets/CreditCardImges/visa.png"
              alt=""
            />
            <input
              class="hidden"
              type="radio"
              id="visa"
              name="payment-method"
            />
          </label>
          <label
            for="paypal"
            class="pmethod border-2 border-neutral-300 hover:border-black shadow rounded transition sm:cursor-pointer"
          >
            <img
              class="rounded w-14 h-10 object-contain"
              src="assets/CreditCardImges/paypal.png"
              alt=""
            />
            <input
              class="hidden"
              type="radio"
              id="paypal"
              name="payment-method"
            />
          </label>
          <label
            for="plus"
            class="border-2 border-neutral-300 hover:border-black shadow rounded transition sm:cursor-pointer"
          >
            <i data-feather="plus"></i>
            <input
              class="hidden"
              type="radio"
              id="plus"
              name="payment-method"
            />
          </label>
        </div>
        
        <?php
                if(isset($_COOKIE['userId']))
                {
                    $userId = $_COOKIE['userId'];
                    $sql = "SELECT SUM(total_price) AS total_sum FROM cart WHERE user_id=$userId";
                    $result = mysqli_query($conn,$sql);
                    if($result)
                    {
                        $row= mysqli_fetch_assoc($result);
                        $total_sum = $row['total_sum'];
                    }
                }
                ?>
        <!-- forms -->
        <!-- default upi -->
        <div class="all-forms">
            <div class="flex flex-col my-4">
                <p class="captcha-text text-center p-2 border-2 rounded-full"></p>
                <label for="captcha">
                  Captcha
                  <i class="inline text-green-400" data-feather="corner-right-up"></i>
                </label>
                <input class="inputCaptcha rounded border-2 border-gray-500 py-2 px-3" type="text" id="captcha" name="captcha" required />
                <p class="captcha-warning hidden text-red-500">Please fill the correct captcha</p>
                <button class="verify-captcha cursor-default sm:cursor-pointer capitalize my-4 py-2 px-8 bg-black w-fit text-white rounded-lg shadow">verify</button>
            </div>

            <!--UPI form -->
          <form action="process_upi_transaction.php" method="post" class="payment-form">
            
            <h2 class="text-xl font-bold capitalize text-center my-4">UPI transaction</h2>
            <div class="">
            <div class="div flex flex-col my-2 w-full">
                <label for="vpa" class="capitalize">enter VPA</label>
                <input class="rounded border-2 border-gray-500 py-2 px-3" type="text" id="vpa" name="vpa" required title="UPI ID" />
                <p class="vpa-warning hidden text-red-500 w-full">Please enter correct VPA format</p>
            </div>
         
            </div>
            <div class="payment flex items justify-between my-4 sm:m-4 shadow-lg p-4 rounded-md">
                <h3 class="font-bold text-lg capitalize">total amount</h3>

                <p class="text-lg font-semibold">₹ <?php echo $total_sum+18?></p>
            </div>
            <div class="text-center">
                <button type="submit" name="pay-now" class="pay-now cursor-default sm:cursor-pointer capitalize text-white bg-black rounded-lg px-6 py-3 w-full sm:w-[60%] mt-3">pay now</button>
            </div>
          </form>

          <!-- credit card form same form for mastercard and visa card  -->
<form action="process_credit_card_transaction.php" method="post" class="hidden payment-form">
    <h2 class="text-xl font-bold capitalize text-center my-4">credit card</h2>
    <div class="sm:grid grid-cols-2 gap-4">
    <div class="flex flex-col my-2">
        <label for="card_number">Card Number</label>
        <input class="f-inp rounded border-2 border-gray-500 py-2 px-3" type="number" id="card_number" name="card_number" maxlength="16" required>
    </div>
    <div class="flex flex-col my-2">
        <label for="expiry_date">Expiry Date</label>
        <input class="f-inp rounded border-2 border-gray-500 py-2 px-3" type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" maxlength="5" required>
    </div>
    <div class="flex flex-col my-2">
        <label for="cvv">CVV</label>
        <input class="f-inp rounded border-2 border-gray-500 py-2 px-3" type="number" id="cvv" name="cvv" maxlength="3" required>
    </div>
    <div class="flex flex-col my-2">
        <label for="card_holder_name">Cardholder Name</label>
        <input class="f-inp rounded border-2 border-gray-500 py-2 px-3" type="text" id="card_holder_name" name="card_holder_name" required>
    </div>
    </div>
    <div class="payment flex items justify-between my-4 sm:m-4 shadow-lg p-4 rounded-md">
      <h3 class="font-bold text-lg capitalize">total amount</h3>
      
      <p class="text-lg font-semibold">₹ <?php echo $total_sum+18?></p>
  </div>
    <div class="text-center">
    <button type="submit" name="pay-now" class="pay-now cursor-default sm:cursor-pointer capitalize text-white bg-black rounded-lg px-6 py-3 w-full sm:w-[60%] mt-3">pay now</button>
    </div>
</form>

        </div>
      </div>
      <!-- changes -->
      </div>
      <!-- breakpoint -->
    </div>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js" integrity="sha512-7Au1ULjlT8PP1Ygs6mDZh9NuQD0A5prSrAUiPHMXpU6g3UMd8qesVnhug5X4RoDr35x5upNpx0A6Sisz1LSTXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/ScrollTrigger.min.js" integrity="sha512-LQQDtPAueBcmGXKdOBcMkrhrtqM7xR2bVrnMtYZ8ImAZhFlIb5xrMqQ6uZviyeSB+4mYj89ta8niiCIQM1Gj0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    feather.replace();
  </script>
  <script src="scripts/buttonBounce.js"></script>
  <script src="scripts/paymentMethodFormVisibility.js"></script>
  <script src="scripts/handleCapcha.js"></script>
  <script src="scripts/fillCreditCard.js"></script>
  <script src="scripts/formValidations.js"></script>
  <script src="scripts/goBack.js"></script>

 </html>
