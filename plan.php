<?php
include('databaseConnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $code = 'ABCD45';
    $p_name = $_POST['p_name'];
    $p_Wprice = $_POST['p_Wprice'];
    $p_Mprice = $_POST['p_Mprice'];
    $p_description = $_POST['p_description'];
    $p_url = $_POST['planImageURL'];
    $category = $_POST['category'];
    $tastePreference = $_POST['tastePreference'];

    $sql = "INSERT INTO `plan`(`code`, `plan_name`, `WeeklyPrice`, `MonthlyPrice`, `p_Description`, `url`, `category`, `Taste_preference`) VALUES ('$code','$p_name','$p_Wprice', '$p_Mprice' ,'$p_description','$p_url','$category','$tastePreference')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Plan Added Successfully!";
    } else {
        echo "Failed!";
    }
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
                <option value="vegetarian">Vegetarian</option>
                <option value="non-vegetarian">Non-Vegetarian</option>
            </select>

            <label for="tastePreference">Taste Preference:</label>
            <select id="tastePreference" name="tastePreference">
                <option value="spicy">Spicy</option>
                <option value="oily">Oily</option>
                <option value="not">Not Spicy/Oily</option>
                <option value="spicy">Spicy/not oily</option>
                <option value="spicy">Oily/not Spicy</option>
            </select>


            <input class="btn" type="submit" value="Add">
        </div>

    </form>
</body>

</html>