<?php

include("databaseConnect.php");

session_start();
// $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veg Food Delights</title>

    <link rel="stylesheet" href="cuisines.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <header>
        <nav>
            <div class="nav-left">
                <img src="images/TT_Logo.png" alt="TTLogo">
                <span>Veg</span>
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
                WHERE p.category = 'veg'";
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

                $query = "SELECT p.*, u.* 
                FROM `plan` p
                JOIN `users` u ON p.user_id = u.Id
                WHERE p.category = 'veg'";

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="chef-card">
                        <img src="<?php echo $row['url'] ?>" alt="chef-img">

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
                <div class="chef-card">
                    <img src="https://res.cloudinary.com/purnesh/image/upload/w_540,f_auto,q_auto:eco,c_limit/pankaj-bhadouria-1.jpg" alt="Chef Anjali">

                    <div class="chef-details">
                        <p class="chef-name">Chef Anjali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.6
                        </div>
                        <p class="address">Chetakpuri</p>
                    </div>

                </div>

                <div class="chef-card">
                    <img src="https://hungryforever.net/wp-content/uploads/2015/07/VIKAS-II.jpg" alt="Chef Raj">

                    <div class="chef-details">
                        <p class="chef-name">Chef Raj</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.7
                        </div>
                        <p class="address">Aamkho</p>
                    </div>
                </div>

                <div class="chef-card">
                    <img src="https://res.cloudinary.com/purnesh/image/upload/w_540,f_auto,q_auto:eco,c_limit/pankaj-bhadouria-1.jpg" alt="Chef Anjali">

                    <div class="chef-details">
                        <p class="chef-name">Chef Anjali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.6
                        </div>
                        <p class="address">ChetakPuri</p>
                    </div>

                </div>

                <div class="chef-card">
                    <img src="https://hungryforever.net/wp-content/uploads/2015/07/VIKAS-II.jpg" alt="Chef Raj">

                    <div class="chef-details">
                        <p class="chef-name">Chef Raj</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.7
                        </div>
                        <p class="address">Aamkho</p>
                    </div>
                </div>

                <div class="chef-card">
                    <img src="https://res.cloudinary.com/purnesh/image/upload/w_540,f_auto,q_auto:eco,c_limit/pankaj-bhadouria-1.jpg" alt="Chef Anjali">

                    <div class="chef-details">
                        <p class="chef-name">Chef Anjali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.6
                        </div>
                        <p class="address">ChetakPuri</p>
                    </div>

                </div>

                <div class="chef-card">
                    <img src="https://hungryforever.net/wp-content/uploads/2015/07/VIKAS-II.jpg" alt="Chef Raj">

                    <div class="chef-details">
                        <p class="chef-name">Chef Raj</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.7
                        </div>
                        <p class="address">Aamkho</p>
                    </div>

                </div>

            </div>
        </section>


        <section class="restaurant-cooked">
            <h2>Restaurant Meal plans</h2>
            <div class="restau-grid">

                <div class="restau-card">
                    <img src="https://media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_1024/3d16d7cc466fc3f7dce770a6a3000ea9" alt="Veg plan 1">

                    <div class="plan-details">
                        <p class="plan-name">Veg Thali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.4
                        </div>
                        <p class="address">Govindpuri</p>
                        <p class="price">₹3150</p>
                    </div>

                </div>

                <div class="restau-card">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Chole_Bhature_from_Nagpur.JPG/1200px-Chole_Bhature_from_Nagpur.JPG" alt="Jain plan 2">

                    <div class="plan-details">
                        <p class="plan-name">Chhole Bhature</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.4
                        </div>
                        <p class="address">Thatipur</p>
                        <p class="price">₹3000</p>
                    </div>
                </div>

                <div class="restau-card">
                    <img src="https://media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_1024/3d16d7cc466fc3f7dce770a6a3000ea9" alt="Veg plan 1">

                    <div class="plan-details">
                        <p class="plan-name">Veg Thali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.4
                        </div>
                        <p class="address">Govindpuri</p>
                        <p class="price">₹3150</p>
                    </div>

                </div>

                <div class="restau-card">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Chole_Bhature_from_Nagpur.JPG/1200px-Chole_Bhature_from_Nagpur.JPG" alt="Jain plan 2">

                    <div class="plan-details">
                        <p class="plan-name">Chhole Bhature</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.4
                        </div>
                        <p class="address">Thatipur</p>
                        <p class="price">₹3000</p>
                    </div>
                </div>

                <div class="restau-card">
                    <img src="https://media-assets.swiggy.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_1024/3d16d7cc466fc3f7dce770a6a3000ea9" alt="Veg plan 1">

                    <div class="plan-details">
                        <p class="plan-name">Veg Thali</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.4
                        </div>
                        <p class="address">Govindpuri</p>
                        <p class="price">₹3150</p>
                    </div>

                </div>

            </div>
        </section>

        <section class="restaurants">
            <h2>Restaurants</h2>
            <div class="restau-grid">

                <div class="restau-card">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/1a/e0/46/74/spice-house.jpg" alt="The Spice House">

                    <div class="restau-details">
                        <p class="restau-name">The spice house</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.2
                        </div>
                        <p class="address">Govindpuri</p>
                    </div>

                </div>

                <div class="restau-card">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/24/61/a3/6b/a-pure-vegetarian-family.jpg" alt="Jain Rasoi">

                    <div class="restau-details">
                        <p class="restau-name">Family Rastaurant</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.6
                        </div>
                        <p class="address">Thatipur</p>
                    </div>

                </div>


                <div class="restau-card">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/1a/e0/46/74/spice-house.jpg" alt="The Spice House">

                    <div class="restau-details">
                        <p class="restau-name">The spice house</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.2
                        </div>
                        <p class="address">Govindpuri</p>
                    </div>

                </div>

                <div class="restau-card">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/24/61/a3/6b/a-pure-vegetarian-family.jpg" alt="Jain Rasoi">

                    <div class="restau-details">
                        <p class="restau-name">Family Rastaurant</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.6
                        </div>
                        <p class="address">Thatipur</p>
                    </div>

                </div>

                <div class="restau-card">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/1a/e0/46/74/spice-house.jpg" alt="The Spice House">

                    <div class="restau-details">
                        <p class="restau-name">The spice house</p>
                        <div class="rating">
                            <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                            4.2
                        </div>
                        <p class="address">Govindpuri</p>
                    </div>

                </div>


            </div>
        </section>

    </main>

    <footer>
        <p>Experience the joy of authentic veg cooking delivered straight to your door.</p>
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
    </script>

    <script>
        console.log("dfd");
        purchasePlan = (() => {
            let purchase = new XMLHttpRequest();
            purchase.open('GET', 'fetch_fullPlan.php?purchase=true&code=', true);
            purchase.send();

            purchase.onreadystatechange = (() => {
                if (purchase.readyState == 4 && purchase.status == 200) {
                    // full_plan.innerHTML = purchase.responseText;

                    console.log("hello");
                }
            })
        })
    </script>

</body>

</html>