<?php
include('databaseConnect.php');
session_start();

$pCode = $_SESSION["plan_code"];
$userMobile = $_SESSION["mobile_number"];

// Fetch user details based on the mobile number
$userQuery = "SELECT `Id`, `First_Name`, `Last_Name`, `Address` FROM `users` WHERE `Mobile_Number` = '$userMobile'";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);
if (!$userData) {
    die("User not found.");
}
$userID = $userData['Id'];
$userName = $userData['First_Name'] . ' ' . $userData['Last_Name'];
$userAddress = $userData['Address'];

$subscriptionQuery = "SELECT * FROM `subscribers` WHERE `userID` = '$userID'";
$subscriptionResult = mysqli_query($conn, $subscriptionQuery);
if (mysqli_num_rows($subscriptionResult) > 0) {
    die("You already have an active subscription. Please cancel your existing subscription before subscribing to a new plan.");
    exit();
}

// Fetch chef details based on the plan code
$planQuery = "SELECT `user_id`, `WeeklyPrice`, `MonthlyPrice` FROM `plan` WHERE `code` = '$pCode'";
$planResult = mysqli_query($conn, $planQuery);
$planData = mysqli_fetch_assoc($planResult);
if (!$planData) {
    die("Plan not found.");
}
$chefID = $planData['user_id'];
$priceType = isset($_GET['price']) && $_GET['price'] == 'WeeklyPrice' ? 'WeeklyPrice' : 'MonthlyPrice';
$planPrice = $priceType == 'WeeklyPrice' ? $planData['WeeklyPrice'] : $planData['MonthlyPrice'];

$chefQuery = "SELECT `First_Name`, `Last_Name`, `Mobile_Number`, `Address` FROM `users` WHERE `Id` = '$chefID'";
$chefResult = mysqli_query($conn, $chefQuery);
$chefData = mysqli_fetch_assoc($chefResult);
if (!$chefData) {
    die("Chef not found.");
}
$chefName = $chefData['First_Name'] . ' ' . $chefData['Last_Name'];
$chefMobile = $chefData['Mobile_Number'];
$chefAddress = $chefData['Address'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $subscription_date = date('Y-m-d');

    // Check if the form is submitted via card or UPI
    if (!empty($_POST['card-no']) && !empty($_POST['cvv'])) {
        $cardNumber = $_POST['card-no'];
        $upi = null; // UPI is not used
    } elseif (!empty($_POST['upi-id'])) {
        $upi = $_POST['upi-id'];
        $cardNumber = null; // Card is not used
    } else {
        die("Please provide either card details or UPI ID.");
    }

    // Insert the data into the subscribers table
    $sql = "INSERT INTO `subscribers`(`userID`, `chefID`, `userName`, `userMobile`, `chefMobile`, `chefName`, `userAddress`, `chefAddress`, `planCode`, `Duration` , `cardNumber`, `Upi`, `subscription_date`) 
            VALUES ('$userID', '$chefID', '$userName', '$userMobile', '$chefMobile', '$chefName', '$userAddress', '$chefAddress', '$pCode', '$priceType', '$cardNumber', '$upi', '$subscription_date')";

    if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">
            alert("Subscription successful!");
            window.location.href = "razorpay.php";
          </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razor Pay - Payment API</title>
    <link rel="shortcut icon" href="https://blog.razorpay.in/blog-content/uploads/2020/10/rzp-glyph-positive.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
            font-weight: 400;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gateway {
            border: 2px solid #ebebeb;
            border-radius: 10px;
        }

        .d-flex {
            display: flex !important;
            justify-content: space-between;
        }

        .header {
            background-color: #045BF2;
            color: #fff;
            gap: 1.5rem;
            padding: 20px 20px 0;
            border-radius: 10px 10px 0 0;
        }

        h3 {
            font-weight: 600;
            font-size: 1.3rem;
        }

        span {
            color: #444447;
            font-weight: 500;
            font-size: 1rem;
        }

        p {
            color: #444447;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .header p {
            background-color: #296CF2;
            margin-top: 5px;
            padding: 3px;
            color: #fff;
            font-size: .85rem;
        }

        .cardPay,
        .upiPay {
            margin: 20px 0;
            padding-inline: 15px;
        }

        .cardComponent,
        .upiComponent {
            border: 2px solid #e8e8e8;
            padding-inline: 20px;
            margin-top: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            cursor: pointer;
        }

        .cardComponent div,
        .upiComponent div {
            gap: 10px;
        }

        .fa-angle-right {
            align-self: center;
        }

        .footer {
            margin-top: 8rem;
        }

        .secured {
            align-items: center;
            padding-inline: 15px;
            background-image: linear-gradient(to bottom, #fefeff, #f6f6f7, #eeeeef, #e7e7e7, #dfdfdf);
            box-shadow: inset 0px 10px 2px 0px rgba(240, 239, 243, 1);
        }

        .secured p {
            font-size: .95rem;
        }

        .fade-tag {
            align-items: center;
            display: flex !important;
        }

        .fade-tag img {
            width: 100px;
        }

        .pay {
            padding: 20px;
            position: relative;
        }

        .bill {
            font-weight: 600;
            color: #000;
        }

        #viewDetails {
            font-size: .7rem;
            color: #757577;
            margin-top: 5px;
            text-decoration: underline;
        }

        button {
            background-image: linear-gradient(to bottom, #256af6, #0655dc);
            border-radius: 8px;
            font-family: Arial;
            color: #ffffff;
            font-size: 18px;
            padding: 15px 40px 15px 40px;
            text-decoration: none;
            border: none;
            position: absolute;
            right: 20px;
        }

        button:hover {
            background-image: linear-gradient(to bottom, #2966e2, #0049c0);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <section class="gateway">
        <div class="header d-flex">
            <img src="https://lh3.googleusercontent.com/RgVqHSvDkg5Gw0_UaeklzrX2_eARmBpRxduqyw2uk54sSe9ErDJL-v6oIyefoxxRMnMhe1YZaoeJtDN9odZ1uo2miPtU=w1200-rw" width="40px" height="50px" alt="projectLogo">
            <div>
                <h3>TiffinTrail</h3>
                <p><i class="fa-solid fa-shield" style="color: #69df95;"></i> Rozarpay Trusted Business <i class="fa-solid fa-circle-info"></i></p>
            </div>
        </div>
        <div class="cardPay" onclick="showCard()">
            <h3>Pay Via Card</h3>
            <div class="cardComponent d-flex">
                <div class="d-flex">
                    <i class="fa-solid fa-credit-card" style="color: #1149aa;"></i>
                    <p>Pay using Card <br> <span>All card Supported</span></p>
                </div>
                <i class="fa-solid fa-angle-right" style="color: #1149aa;"></i>
            </div>
        </div>
        <div class="cardPay d-none" id="credit-card">
            <h3>Enter Card Details</h3>
            <form method="POST" action="razorpay.php" class="border shadow position-relative rounded-5 user-card d-flex">
                <img src="images/card.jpg" alt="credit-card" class="w-100">
                <input type="phone" name="card-no" oninput="checkCardNo(this.value+'')" style="bottom: 20px; right: 80px;" required class="position-absolute text-light bg-transparent form-control w-75" placeholder="XXXX XXXX XXXX XXXX">
                <input type="phone" name="cvv" style="top: 20px; right: 10px; width: 50px !important;" required class="position-absolute text-light bg-transparent form-control w-75" placeholder="cvv">
                <img src="./images/loading.gif" style="right: 10px; bottom: 20px; width: 50px;" alt="crad-company" id="card-company" class="bg-info p-1 rounded card-company position-absolute">
                <button type="submit" class="d-none" name="submit" id="card-submit-btn">Submit</button>
            </form>
        </div>

        <div class="upiPay" onclick="showUPI()">
            <h3>Pay Via UPI</h3>
            <div class="upiComponent d-flex">
                <div class="d-flex">
                    <img src="https://i.postimg.cc/QCdw2bSd/upi-id-icon.png" width="20px" alt="">
                    <p>Pay with UPI <br></p>
                </div>
                <i class="fa-solid fa-angle-right" style="color: #1149aa;"></i>
            </div>
        </div>
        <div class="upiPay d-none" id="upiPay">
            <h3>Enter UPI Details</h3>
            <form method="POST" action="razorpay.php" class="upiComponent d-flex">
                <input type="text" name="upi-id" placeholder="UPI ID/Mobile No." required class="form-control">
                <button type="submit" name="submit" id="card-upi-btn" class="d-none">Submit</button>
            </form>
        </div>

        <div class="footer">
            <div class="secured d-flex">
                <p style="color: #000;">Account <i class="fa-solid fa-angle-up" style="color: #1149aa;"></i></p>
                <p class="fade-tag d-flex">Secured by <img src="https://sellonboard.com/wp-content/uploads/2021/09/razorpay.png" alt=""></p>
            </div>
            <div class="pay d-flex">
                <div class="paymentDetails">
                    <p class="bill">₹ <?php echo $planPrice; ?></p>
                    <p id="viewDetails">View Details</p>
                </div>
                <button onclick="submitPaymentDetails()">Pay Now</button>
            </div>
        </div>
    </section>

    <script>
        const card = document.querySelector('#credit-card');
        const cardBrand = document.querySelector('#card-company');
        const cardBTN = document.querySelector('#card-submit-btn');
        const UPI = document.querySelector('#upiPay');
        const UPIBTN = document.querySelector('#card-upi-btn');
        const cards = ['master', 'visa', 'rupay', 'american-express'];
        let isCardPay = false;

        const showCard = () => {
            card.classList.toggle('d-none');
            UPI.classList.add('d-none');
            isCardPay = !isCardPay;
        };

        const showUPI = () => {
            UPI.classList.toggle('d-none');
            card.classList.add('d-none');
            isCardPay = (isCardPay) ? !isCardPay : isCardPay;
        };

        const checkCardNo = (val) => {
            if (val.length < 12 || val.length > 12) {
                cardBrand.src = `./images/loading.gif`;
                return;
            }
            cardBrand.src = `./images/${cards[(Math.floor(Math.random() * 100) % 4)]}-card.png`;
        };

        const submitPaymentDetails = () => {
            if (isCardPay) {
                cardBTN.click();
            } else {
                UPIBTN.click();
            }
        };
    </script>
</body>

</html>