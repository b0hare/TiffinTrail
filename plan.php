<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: registration.php");
    exit();
}

include('databaseConnect.php');

// Fetch the user ID using the session variable
if (isset($_SESSION["mobile_number"])) {
    $stmt = $conn->prepare("SELECT `Id` FROM `users` WHERE `Mobile_Number` = ?");
    $stmt->bind_param("s", $_SESSION["mobile_number"]);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    if ($userId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $p_name = $_POST['p_name'];
            $p_Wprice = $_POST['p_Wprice'];
            $p_Mprice = $_POST['p_Mprice'];
            $p_description = $_POST['p_description'];
            $p_url = $_POST['planImageURL'];
            $category = $_POST['category'];
            $tastePreference = $_POST['tastePreference'];

            $sql = "INSERT INTO `plan`(`user_id`, `plan_name`, `WeeklyPrice`, `MonthlyPrice`, `p_Description`, `url`, `category`, `Taste_preference`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isddssss", $userId, $p_name, $p_Wprice, $p_Mprice, $p_description, $p_url, $category, $tastePreference);

            if ($stmt->execute()) {
                echo "Plan Added Successfully!";
                header("Location: plan.php");
                exit();
            } else {
                echo "Failed: " . $conn->error;
            }
            $stmt->close();
        }
    } else {
        echo "User ID not found.";
    }
} else {
    echo "No mobile number found in session.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Trail - Plans</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="plan.css">

</head>

<body>
    <form class="container" action="plan.php" method="post">
        <h1>Our Plans</h1>

        <div class="plan">
            <label for="planName">Plan Name:</label>
            <input type="text" id="planName" name="p_name" required>

            <label for="Wprice">Weekly Price:</label>
            <input type="number" id="Wprice" name="p_Wprice" required>

            <label for="Mprice">Monthly Price:</label>
            <input type="number" id="Mprice" name="p_Mprice" required>

            <label for="description">Description:</label>
            <textarea id="description" name="p_description" rows="4" placeholder="Enter food items with their qantity. For Ex- 1 Bowl Daal, 6 Roti.. " required></textarea>

            <div id="planImg">
                <label for="planImageURL">Image URL:</label>
                <input type="text" id="planImageURL" name="planImageURL" placeholder="Enter image url(link)" required>
                <a href="https://postimages.org/#google_vignette" target="_blank">Click and upload image to get url</a>
            </div>

            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="jain">Jain</option>
                <option value="veg">Vegetarian</option>
                <option value="non-veg">Non-Vegetarian</option>
            </select>

            <label for="tastePreference">Taste Preference:</label>
            <select id="tastePreference" name="tastePreference">
                <option value="Not Spicy/Oily">Not Spicy/Oily</option>
                <option value="Spicy">Spicy</option>
                <option value="Oily">Oily</option>
                <option value="Spicy/not Oily">Spicy/not oily</option>
                <option value="Oily/not Spicy">Oily/not Spicy</option>
            </select>


            <input class="btn" type="submit" value="Add">
        </div>

    </form>
</body>

</html>