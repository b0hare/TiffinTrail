<?php

include 'databaseConnect.php';
session_start();

if (!isset($_SESSION["chefname"])) {
    header("Location: registration.php");
    exit();
} else {
    $chefname = $_SESSION["chefname"];
    $M_no = $_SESSION["chefMobile"];
}

// Fetch subscriber details
$subscribersQuery = "SELECT s.userID, s.userName, s.userAddress FROM subscribers s";
$subscribersResult = mysqli_query($conn, $subscribersQuery);

// Store subscriber details
$subscribersData = [];
while ($row = mysqli_fetch_assoc($subscribersResult)) {
    $subscribersData[] = $row;
}

// Fetch user profile images based on userID
$profileImages = [];
foreach ($subscribersData as $subscriber) {
    $userID = $subscriber['userID'];
    $usersQuery = "SELECT ProfileImg FROM users WHERE Id = '$userID'";
    $usersResult = mysqli_query($conn, $usersQuery);
    $userData = mysqli_fetch_assoc($usersResult);
    if ($userData) {
        $profileImages[$userID] = $userData['ProfileImg'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Trail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="chef.css">

</head>

<body>

    <header class="hero_section">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://lh3.googleusercontent.com/RgVqHSvDkg5Gw0_UaeklzrX2_eARmBpRxduqyw2uk54sSe9ErDJL-v6oIyefoxxRMnMhe1YZaoeJtDN9odZ1uo2miPtU=w1200-rw" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                    Tiffin Trail
                </a>

                <div class="navRight">
                    <a href="plan.php" class="addPlan">Add Plan</a>
                    <!-- Drop Down -->

                    <div class="dropdown">
                        <i class="fas fa-user"></i>
                        <div class="dropdown-content">
                            <a href="updateProfile.php" id="editProfileLink">Edit Profile</a>
                            <p id="logOut">LogOut</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="hero_content">

            <div class="hero_text">
                <h1 class="primary WName">Tiffin <span>Trail</span></h1>
                <p id="tag_line"></p>
            </div>
        </div>

    </header>

    <!-- Orders and Subs..  -->

    <section id="orders_section" class="d-flex mx-3 my-5 pt-5">

        <h2 class="no-of-orders secondary">Today's Order ☛ <span>4</span></h2>

        <div class="orders my-5">

            <div class="order d-flex px-3 align-items-center mb-3">
                <img src="https://www.healthifyme.com/blog/wp-content/uploads/2021/10/1500-Calorie-Vegetarian-Diet-Plan.jpg" alt="plan_image" width="35%">

                <div class="order_desc">

                    <h3 class="plan-name tertiary">Green Diet</h3>
                    <h4 class="quaternary subs-name lead">Pallavi, Chetakpuri</h4>
                    <div class="status text-warning">pending</div>

                </div>
            </div>

            <div class="order d-flex px-3 align-items-center mb-2">
                <img src="https://www.visittobengal.com/blog/wp-content/uploads/North-Eastern-Cuisine.jpg" alt="plan_image" width="35%">

                <div class="order_desc">

                    <h3 class="plan-name tertiary">The Unique Seven</h3>
                    <h4 class="quaternary subs-name lead">Raj, Aamkho</h4>
                    <div class="status text-warning">pending</div>

                </div>
            </div>

            <div class="order d-flex px-3 align-items-center mb-3">
                <img src="https://www.healthifyme.com/blog/wp-content/uploads/2021/10/1500-Calorie-Vegetarian-Diet-Plan.jpg" alt="plan_image" width="35%">

                <div class="order_desc">

                    <h3 class="plan-name tertiary">Green Diet</h3>
                    <h4 class="quaternary subs-name lead">Pallavi, Chetakpuri</h4>
                    <div class="status text-warning">pending</div>

                </div>
            </div>

            <div class="order d-flex px-3 align-items-center mb-2">
                <img src="https://www.visittobengal.com/blog/wp-content/uploads/North-Eastern-Cuisine.jpg" alt="plan_image" width="35%">

                <div class="order_desc">

                    <h3 class="plan-name tertiary">The Unique Seven</h3>
                    <h4 class="quaternary subs-name lead">Raj, Aamkho</h4>
                    <div class="status text-warning">pending</div>

                </div>
            </div>

        </div>

    </section>

    <section id="subs_section">
        <h2 class="no-of-subs secondary">Your Subscribers ☛ <span>4</span></h2>

        <div class="Subscribers d-flex my-5">

        <?php
            foreach ($subscribersData as $subscriber) {
                $userID = $subscriber['userID'];
                $userName = $subscriber['userName'];
                $userAddress = $subscriber['userAddress'];
                $profileImg = isset($profileImages[$userID]) ? $profileImages[$userID] : 'default.jpg'; // Default image if not found
            ?>
                <div class="subscriber mb-3">
                    <img src="<?php echo $profileImg; ?>" alt="subscriber-img">

                    <div class="subs-detail">
                        <h3 class="subs-name tertiary ps-4"><?php echo $userName; ?></h3>
                        <h4 class="quaternary subs-name lead ps-4"><?php echo $userAddress; ?></h4>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="subscriber mb-3">
                <img src="https://img.freepik.com/premium-vector/businessman-character-avatar-isolated_24877-5037.jpg?size=626&ext=jpg&ga=GA1.1.379443224.1710346056&semt=ais" alt="subs-1">

                <div class="subs-detail">
                    <h3 class="subs-name tertiary ps-4">Raj</h3>
                    <h4 class="quaternary subs-name lead ps-4">Aamkho</h4>
                </div>

            </div>

            <div class="subscriber">
                <img src="https://img.freepik.com/premium-photo/3d-animation-character-cartoon_113255-10852.jpg?w=740" alt="subs-1">

                <div class="subs-detail">
                    <h3 class="subs-name tertiary ps-4">Pallavi</h3>
                    <h4 class="quaternary subs-name lead ps-4">Chetakpuri</h4>
                </div>

            </div>

        </div>

    </section>


    <!-- plans section  -->

    <section id="plan_section" class="mx-3 my-5 pt-2 pb-5">

        <h2 class="secondary my-5">Your Plans</h2>
        <div class="plans d-flex">

            <?php
            include("databaseConnect.php");
            $query = " SELECT p.*
            FROM `plan` p
            JOIN `users` u ON p.`user_id` = u.`Id`
            WHERE u.`Mobile_Number` = '$M_no'";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {

            ?>
                <div class="plan">

                    <img src="<?php echo $row['url'] ?>" alt="">

                    <div class="plan-details">
                        <p class="plan-name"><?php echo $row['plan_name'] ?></p>
                        <div class="prices">
                            <p><b>Weekly:</b> &ThickSpace;<span class="plan-price">₹<?php echo $row['WeeklyPrice'] ?></span></p>
                            <p><b>Monthly:</b> <span class="plan-price">₹<?php echo $row['MonthlyPrice'] ?></span></p>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>

            <button class="btn">See All</button>

        </div>

    </section>

    <!-- Footer  -->

    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <p>&copy;2024 Tiffin Trail | All Rights Reserved</p>
    </footer>


    <script>
        function animate_tagLine() {
            let tagP = document.getElementById("tag_line");
            let tagLine = "A path to Homemade and Restaurant Quality Meals";
            let index = 0;

            let appear_tagline = setInterval(() => {

                tagP.textContent += tagLine[index];
                index++;
                if (index === tagLine.length) {
                    clearInterval(appear_tagline);
                }

            }, 100);
        }

        window.onload = animate_tagLine();


        // logOut function 
        function logOut() {
            window.location.href = 'logOut.php';
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const logOutElement = document.getElementById('logOut');
            if (logOutElement) {
                logOutElement.addEventListener('click', logOut);
            }
        });
    </script>


</body>

</html>