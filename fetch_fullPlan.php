<?php

    session_start();
    if(isset($_GET['fetch_plan'])){

        include ("databaseConnect.php");
       
        if($_GET['fetch_plan']== 'true')
        {
            $code = $_GET['code'];

            $querry = "SELECT p.*, u.Address 
            FROM `plan` p
            JOIN `users` u ON p.user_id = u.Id
            WHERE p.code = '$code'";

            $result = mysqli_query($conn, $querry);
            $row = $result->fetch_assoc();

            ?>


            <div class="plan-card">
                <img src="<?php echo $row['url'] ?>" alt="Veg plan 1">

                <div class="plan-details">
                    <p class="plan-name"><?php echo $row['plan_name'] ?></p>
                    <div class="rating">
                        <div class="r-circle"><i class="fa-solid fa-star"></i></div>
                        4.4
                    </div>
                    <p class="address"><?php echo $row['Address'] ?></p>
                    <div class="prices">
                    <p>Weekly: &ThickSpace;<span class="price">₹<?php echo $row['WeeklyPrice'] ?></span></p>
                    <p>Monthly: <span class="price">₹<?php echo $row['MonthlyPrice'] ?></span></p>
                    </div>
                </div>
            </div>

            <div class="includes">
                <h2>Tiffin Box Includes</h2>
                <p>➛<?php echo $row['p_Description'] ?></p>
                <p class="itemPerDay">Two times a day (1 Item/day)</p>
                <button id="buy" onclick="purchasePlan()">Buy</button>
            </div>
        <?php
        }
    }


    if(isset($_GET['purchase'])){
        if(!isset($_SESSION["username"])){
            echo "helfkl;ajfklj";
            header("Location: registration.php");
        }
        exit();
    }
?>