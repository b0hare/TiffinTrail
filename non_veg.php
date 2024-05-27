<?php

include("databaseConnect.php");

session_start();

if (!isset($_SESSION["chefname"])) {
    $username = $_SESSION["mobile_number"];
    $M_no = $_SESSION["mobile_number"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Veg Food</title>

    <link rel="stylesheet" href="cuisines.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <header>
        <nav>
            <div class="nav-left">
                <img src="images/TT_Logo.png" alt="TTLogo">
                <span>Non-Veg</span>
            </div>

            <div class="nav-right">

                <div class="search">
                    <input type="search" name="" placeholder="Search food">
                    <button type="submit">Search</button>
                    <a href=""><i class="fa-solid fa-magnifying-glass" style="color: #3A7F00;"></i></a>
                </div>

                <i class="fas fa-user"></i>
        </nav>
    </header>

    <main>


        <!-- Full plan  -->


        <div id="full-plan">

        </div>

        <!-- Home-cooked section  -->

        <section class="home-cooked">
            <h2>Home-Cooked Meal Plans</h2>
            <div class="plan-grid">

                <?php
                $query = "SELECT p.*, u.Address 
                FROM `plan` p
                JOIN `users` u ON p.user_id = u.Id
                WHERE p.category = 'non-veg' AND u.ServiceType = 'Individual'";
      
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="plan-card" onclick="fetchPlan('<?php echo $row['code'] ?>')">
                        <img src="<?php echo $row['url'] ?>" alt="Veg plan 1">

                        <div class="plan-details">
                            <p class="plan-name"><?php echo $row['plan_name'] ?></p>
                            <div class="rating">
                                <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                                4.4
                            </div>
                            <p class="address"><?php echo $row['Address'] ?></p>
                            <p class="price">₹<?php echo $row['MonthlyPrice'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </section>



        <section class="home-cooks">
            <h2>Home Cooks</h2>
            <div class="chef-grid">

                <?php

                $query = "SELECT DISTINCT u.Id, u.First_Name,Last_Name,u.Mobile_Number, u.Address, u.ProfileImg
                FROM `plan` p
                JOIN `users` u ON p.user_id = u.Id
                WHERE p.category = 'non-veg' AND u.ServiceType = 'Individual'";

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="chef-card">
                        <img src="<?php echo $row['ProfileImg'] ?>" alt="chef-img">

                        <div class="chef-details">
                            <p class="chef-name">Chef <?php echo $row['First_Name'] ?></p>
                            <div class="rating">
                                <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                                4.4
                            </div>
                            <p class="address"><?php echo $row['Address'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </section>


        <section class="restaurant-cooked">
            <h2>Restaurant Meal plans</h2>
            <div class="restau-grid">

            <?php
                $query = "SELECT p.*, u.Address 
                FROM `plan` p
                JOIN `users` u ON p.user_id = u.Id
                WHERE p.category = 'non-veg' AND u.ServiceType = 'Business'";
      
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="plan-card" onclick="fetchPlan('<?php echo $row['code'] ?>')">
                        <img src="<?php echo $row['url'] ?>" alt="Veg plan 1">

                        <div class="plan-details">
                            <p class="plan-name"><?php echo $row['plan_name'] ?></p>
                            <div class="rating">
                                <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                                4.4
                            </div>
                            <p class="address"><?php echo $row['Address'] ?></p>
                            <p class="price">₹<?php echo $row['MonthlyPrice'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </section>

        <section class="restaurants">
            <h2>Restaurants</h2>
            <div class="restau-grid">

            <?php

                $query = "SELECT DISTINCT u.Id, u.First_Name,Last_Name,u.Mobile_Number, u.Address, u.ProfileImg
                FROM `plan` p
                JOIN `users` u ON p.user_id = u.Id
                WHERE p.category = 'non-veg' AND u.ServiceType = 'Business'";

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="chef-card">
                        <img src="<?php echo $row['ProfileImg'] ?>" alt="chef-img">

                        <div class="chef-details">
                            <p class="chef-name"><?php echo $row['First_Name']?> <?php echo $row['Last_Name']?></p>
                            <div class="rating">
                                <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                                4.4
                            </div>
                            <p class="address"><?php echo $row['Address'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </section>

    </main>

    <footer>
        <p>Experience the joy of authentic non-veg cooking delivered straight to your door.</p>
        <p class="copyright">&copy; Tiffin Trail. All Rights Reserved.</p>
    </footer>


    <script>
        let full_plan = document.getElementById('full-plan');

        function fetchPlan(value) {

            let fetch_plan = new XMLHttpRequest();
            fetch_plan.open('GET', 'fetch_fullPlan.php?fetch_plan=true&code=' + value, true);
            fetch_plan.send();

            fetch_plan.onreadystatechange = (() => {
                if (fetch_plan.readyState == 4 && fetch_plan.status == 200) {
                    full_plan.innerHTML = fetch_plan.responseText;

                    full_plan.style.display = "flex";

                    document.querySelector("main").style.visibility = "hidden";

                    document.querySelector("footer").style.display = "none";
                }

                let iconElement = document.createElement("i");

                iconElement.classList.add("fa-solid", "fa-xmark");

                full_plan.appendChild(iconElement);

                let xMark = document.querySelector(".fa-xmark");

                xMark.onclick = () => {
                    full_plan.style.display = "none";

                    document.querySelector("main").style.visibility = "visible";

                    document.querySelector("footer").style.display = "block";

                }
            })
        }

        function purchasePlan() {
            const loggedIn = <?php echo isset($_SESSION["username"]) ? 'true' : 'false'; ?>;
            if (!loggedIn) {
                window.location.href = 'registration.php';
            } else {
                window.location.href = 'paymentGateway.php';
            }
        }
    </script>

</body>

</html>