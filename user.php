<?php

session_start();

include "databaseConnect.php";

if (!isset($_SESSION["username"])) {
    header("Location: registration.php");
    exit();
}

$username = $_SESSION["username"];
$M_No = $_SESSION["mobile_number"];

$query = "SELECT `First_Name`, `Last_Name`, `Email`, `Mobile_Number`, `Password`, `Address`, `ProfileImg`, `Gender`, `Role` FROM `users` WHERE `Mobile_Number` = '$M_No'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location: registration.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Trail</title>

    <link rel="stylesheet" href="index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <header class="hero_section">
        <nav>
            <div class="left">
                <div><img id="logo" src="images/TT_Logo.png" alt="">
                    <h3 class="tertiary">
                        <span>T</span>
                        <span>i</span>
                        <span>f</span>
                        <span>f</span>
                        <span>i</span>
                        <span>n</span>
                        <span>Trail</span>
                    </h3>
                </div>

                <ul>
                    <li><a href="" class="active">Home</a></li>
                    <li><a href="#second">Cuisines</a></li>
                    <li><a href="#third">Services</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </div>

            <div class="right">
                <input type="search" name="" placeholder="Search food">
                <button type="submit">Search</button>

                <div id="bar" onclick="menu_bar()" class="opacity8">
                    <div id="line1"></div>
                    <div id="line2"></div>
                    <div id="line3"></div>
                </div>

                <!-- Drop Down -->

                <div class="dropdown">
                    <i class="fas fa-user">&nbsp; <?php echo $username; ?></i>
                    <div class="dropdown-content">
                        <a href="updateProfile.php" id="editProfileLink">Edit</a>
                        <p id="logOut">LogOut</p>
                    </div>
                </div>

            </div>


        </nav>

        <div class="hero_content">

            <div class="hero_text">
                <h1 class="primary">Tiffin <span>Trail</span></h1>
                <p id="tag_line"></p>
            </div>
        </div>

    </header>
    <hr>

    <!-- Cuisine section  -->

    <section id="second">
        <h2 class="secondary">Our Cuisine</h2>

        <p class="aboutSecond">Explore diverse cuisines at Tiffin Trail! From vegetarian comfort to Jain mindfulness and
            indulgent non-vegetarian delights, there's something for everyone.</p>

        <div class="cuisines">

            <div class="dish_desc">

                <h3 class="tertiary">Veg</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="veg.php">Explore</a></p>

            </div>

            <div class="dish">
                <img src="https://www.bandhavgarhnationalpark.in/uploads/traditional-food-of-madhya-pradesh.jpg" alt="">
            </div>

        </div>

        <div class="cuisines">

            <div class="dish_desc">

                <h3 class="tertiary">Jain</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="jain.php">Explore</a>

            </div>

            <div class="dish">
                <img src="https://mythgyaan.com/wp-content/uploads/2017/09/maxresdefault.jpg" alt="">
            </div>

        </div>

        <div class="cuisines">

            <div class="dish_desc">

                <h3 class="tertiary">Non-veg</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="non_veg.php">Explore</a>


            </div>

            <div class="dish">
                <img src="https://www.watscooking.com/images/dish/normal/chicken-thali1.jpg" alt="">
            </div>

        </div>
    </section>
    <hr>

    <section id="third">
        <h2 class="secondary">Our Services</h2>
        <p id="welcome">We pride ourselves on providing a wide array of services to cater to your unique culinary
            desires. No matter if you're in the mood for a hearty homemade meal, trying out new restaurant cuisines, or
            in need of convenient meal options, we have got you covered.</p>

        <p id="serviceP" style="width: fit-content;">Our Top-Quality Services</p>

        <div class="services">

            <div class="service_desc">
                <h3 class="tertiary">Home-cooked Meal Delivery</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="#">Explore</a>
            </div>

            <div class="service">
                <img src="images/Home Kitchen.png" alt="">
            </div>

        </div>

        <div class="services">

            <div class="service_desc">
                <h3 class="tertiary">Restaurant Meal Delivery</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="#">Explore</a>
            </div>

            <div class="service">
                <img src="images/Restau Kitchen.png" alt="">
            </div>

        </div>


        <div class="services">

            <div class="service_desc">
                <h3 class="tertiary">Meal Subscriptions</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="#">Explore</a>
            </div>

            <div class="service">
                <img src="images/Meal Subs.png" alt="">
            </div>

        </div>

        <div class="services">

            <div class="service_desc">
                <h3 class="tertiary">Custom Meal Plans</h3>
                <p class="cuisine_des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolorem dolorum
                    adipisci veniam sequi!</p>
                <a class="a_link" href="#">Explore</a>
            </div>

            <div class="service">
                <img src="images/CustoMealPlan.png" alt="">
            </div>

        </div>

    </section>
    <hr>

    <!-- About section  -->

    <section id="about">
        <h2 class="secondary">About Us</h2>
        <p>Tiffin Trail is a tiffin delivery site based in Gwalior, MP, that bridges the gap between users and a variety
            of home-cooked meals and restaurant delights.
            <br><br>
            Our platform aims to provide a seamless experience for those looking to enjoy delicious meals from local
            cooks and eateries, all conveniently delivered to their doorstep.
        </p>
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
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#second">Cuisine</a></li>
            <li class="menu__item"><a class="menu__link" href="#third">Services</a></li>
            <li class="menu__item"><a class="menu__link" href="#about">About</a></li>

        </ul>
        <p>&copy;2024 Tiffin Trail | All Rights Reserved</p>
    </footer>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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

        // To active button 

        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll("nav .left ul a");
            const footerLinks = document.querySelectorAll(".footer .menu__link");

            navLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    // Remove active class from all nav links
                    navLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });

                    // Add active class to the clicked nav link
                    this.classList.add("active");

                    // Remove active class from all footer links
                    footerLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });

                    // Find the corresponding footer link and add active class
                    const targetFooterLink = document.querySelector('.footer .menu__link[href="' + this.getAttribute("href") + '"]');
                    if (targetFooterLink) {
                        targetFooterLink.classList.add("active");
                    }
                });
            });

            footerLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    // Remove active class from all footer links
                    footerLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });

                    // Add active class to the clicked footer link
                    this.classList.add("active");

                    // Remove active class from all nav links
                    navLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });

                    // Find the corresponding nav link and add active class
                    const targetNavLink = document.querySelector('nav .left ul a[href="' + this.getAttribute("href") + '"]');
                    if (targetNavLink) {
                        targetNavLink.classList.add("active");
                    }
                });
            });
        });

        let line1 = document.getElementById("line1");
        let line2 = document.getElementById("line2");
        let line3 = document.getElementById("line3");

        function menu_bar() {

            document.getElementById("bar").classList.toggle("opacity8");

            line2.classList.toggle("v-none");

            line3.classList.toggle("rotate-up");

            line1.classList.toggle("rotate-down");
        }

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