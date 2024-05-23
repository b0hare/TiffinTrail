<?php

session_start();
include "databaseConnect.php";

$username = $_SESSION["username"];
$M_No = $_SESSION["mobile_number"];

$query = "SELECT `First_Name`, `Last_Name`, `Email`, `Mobile_Number`, `Password`, `Address`, `ProfileImg`, `Gender`, `Role` FROM `users` WHERE `Mobile_Number` = '$M_No'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user data: " . mysqli_error($conn);
    $user = null;
}

// Initialize form field variables
$firstName = $user['First_Name'] ?? '';
$lastName = $user['Last_Name'] ?? '';
$email = $user['Email'] ?? '';
$mobileNumber = $user['Mobile_Number'] ?? '';
$password = ''; // Leave empty for security reasons, don't prefill password fields
$address = $user['Address'] ?? '';
$profileImg = $user['ProfileImg'] ?? '';
$gender = $user['Gender'] ?? '';
$role = $user['Role'] ?? '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        // Update profile logic
        $firstName = filter_input(INPUT_POST, "F_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "L_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST["email"];
        $mobileNumber = $_POST["mobile_number"];
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = $_POST['gender'];
        $profileImg = $_POST['ProfileImg'];

        if ($_POST["password"] !== $_POST["C_password"]) {
            echo "Passwords do not match.";
            exit();
        }

        $_SESSION["username"] = $firstName;
        $_SESSION["mobile_number"] = $M_no;

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if (empty($profileImg)) {
            if ($gender == 'Male') {
                $profileImg = 'https://img.freepik.com/premium-vector/curry-dishes_78118-131.jpg';
            } else if ($gender == 'Female') {
                $profileImg = 'https://st2.depositphotos.com/8322640/48266/v/450/depositphotos_482669160-stock-illustration-lady-chef-holding-frypan-hand.jpg';
            }
        }

        $query = "UPDATE `users` SET 
                    `First_Name` = '$firstName', 
                    `Last_Name` = '$lastName', 
                    `Email` = '$email', 
                    `Mobile_Number` = '$mobileNumber', 
                    `Password` = '$password', 
                    `Address` = '$address', 
                    `ProfileImg` = '$profileImg', 
                    `Gender` = '$gender'
                  WHERE `Mobile_Number` = '$M_No'";

        if (mysqli_query($conn, $query)) {
            // Redirect based on user role
            if ($role == 'Customer') {
                header("Location: user.php");
            } else {
                header("Location: chef.php");
            }
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['delete'])) {
        // Delete account logic
        $deletePassword = $_POST['password'];

        $query = "SELECT `Password` FROM `users` WHERE `Mobile_Number` = '$M_No'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($deletePassword, $user['Password'])) {
            $deleteQuery = "DELETE FROM `users` WHERE `Mobile_Number` = '$M_No'";
            if (mysqli_query($conn, $deleteQuery)) {
                // Redirect to registration page after deleting account
                header("Location: registration.php");
                exit();
            } else {
                echo "Error deleting account: " . mysqli_error($conn);
            }
        } else {
            echo "Incorrect password.";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdateProfile</title>
    <link rel="stylesheet" href="updateProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div id="container" class="container align-items-center">
        <div class="form-wrapper align-items-center">
            <form action="updateProfile.php" method="post" class="form sign-up">

                <div class="input-group">
                    <label for="ProfileImg">Profile Image Link</label>
                    <input type="text" id="ProfileImg" name="ProfileImg" placeholder="Enter Profile image url(link)" value="<?php echo htmlspecialchars($profileImg); ?>">
                    <a href="https://postimages.org/#google_vignette" style="text-decoration: none;" target="_blank">Click and upload image to get url</a>
                </div>

                <div class="input-group">
                    <label for="F_name">First Name</label>
                    <input type="text" id="F_name" name="F_name" placeholder="First Name" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="input-group">
                    <label for="L_name">Last Name</label>
                    <input type="text" id="L_name" name="L_name" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="input-group">
                    <label for="mobile_number">Mobile</label>
                    <input type="number" id="mobile_number" name="mobile_number" placeholder="Mobile number" value="<?php echo htmlspecialchars($mobileNumber); ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <label for="C_password">Confirm Password</label>
                    <input type="password" id="C_password" name="C_password" placeholder="Confirm password" required>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter Your Address" value="<?php echo htmlspecialchars($address); ?>" maxlength="20" required>
                </div>

                <!-- Gender  -->
                <div class="input-group GenderDiv">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <div class="buttons">
                    <input class="submit" type="submit" value="Update Profile" name="update_profile">
                    <button class="btn" id="DA_btn" type="button" onclick="displayDeleteSection()">Delete Account</button>
                </div>
            </form>

            <div class="deleteSection" style="display: none;">
                <i class="fa-solid fa-xmark" onclick="hideDeleteSection()"></i>
                <h2>Delete Account</h2>
                <form action="updateProfile.php" method="post">
                    <div class="input-group">
                        <label for="delete_password">Confirm Password:</label>
                        <input type="password" id="delete_password" name="password" placeholder="Enter Password to Delete Account" required>
                        <input type="submit" name="delete" value="Delete" class="btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function displayDeleteSection() {
            document.querySelector("form.sign-up").style.filter = "blur(7px)";
            document.querySelector(".deleteSection").style.display = "block";
        }

        function hideDeleteSection() {
            document.querySelector("form.sign-up").style.filter = "blur(0px)";
            document.querySelector(".deleteSection").style.display = "none";
        }
    </script>
</body>

</html>