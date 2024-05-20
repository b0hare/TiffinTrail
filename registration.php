<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['SignUp'])) {
        if ($_POST['captcha_input'] !== $_SESSION['captcha']) {

            echo "Incorrect Captcha!";
            exit(); // Stop further execution
        }
    }

    include('databaseConnect.php'); // connecting to database

    if (isset($_POST["role"])) {
        $firstName = filter_input(INPUT_POST, "F_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "L_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST["email"];

        if ($_POST["password"] !== $_POST["C_password"]) {
            echo "Passwords do not match.";
            exit();
        }
        
        $M_no = $_POST["mobile_number"];
        $password = password_hash(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
        $C_pass = filter_input(INPUT_POST, "C_password", FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
        $role = $_POST["role"];
        $ServiceType = $_POST["ServiceType"];

        try {
            $conn = mysqli_connect($server, $user, $pass, $db);
        } catch (mysqli_sql_exception) {
            echo "Could not connect.";
        }

        if ($conn) {
            $sql = "INSERT INTO users(First_Name, Last_Name, Email, Mobile_Number, Password, address, Role, ServiceType)
            VALUES  ('$firstName', '$lastName', '$email', '$M_no', '$password', '$address', '$role', '$ServiceType')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // echo "Registration Successfull!";
                $_SESSION["username"] = $firstName;
                $_SESSION["mobile_number"] = $M_no;


                $fetchRole = "SELECT `Role` FROM `users` WHERE Mobile_Number = '$M_no'";
                $F_result = mysqli_query($conn, $fetchRole);

                if ($F_result) {
                    $F_row = mysqli_fetch_assoc($F_result);

                    if ($F_row['Role'] == "Customer") {
                        header("Location: user.php");
                    } else {
                        header("Location: chef.php");
                    }
                }
            } else {
                echo "Sorry! Failed to register.";
            }
        }

        exit();
    } else {
        $M_no = $_POST["mobile_number"];
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "SELECT First_Name, Password FROM users WHERE Mobile_Number = '$M_no'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row && isset($row['Password'])) {
                $hashed_pass = $row['Password'];
                if (password_verify($password, $hashed_pass)) {
                    // echo "Loged in Successfully!";

                    $_SESSION["username"] = $row['First_Name'];
                    $_SESSION["mobile_number"] = $M_no;
                    

                    $fetchRole = "SELECT `Role` FROM `users` WHERE Mobile_Number = '$M_no'";
                    $F_result = mysqli_query($conn, $fetchRole);

                    if ($F_result) {
                        $F_row = mysqli_fetch_assoc($F_result);

                        if ($F_row['Role'] == "Customer") {
                            header("Location: user.php");
                        } else {
                            header("Location: chef.php");
                        }
                    }
                } else {
                    echo "Incorrect Password!";
                }
            } else {
                echo "Incorrect Mobile number or Password!";
            }
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="registration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <form action="registration.php" method="post" class="form sign-up">
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="First Name" name="F_name" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="Last Name" name="L_name" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" placeholder="Your Email" name="email" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="number" placeholder="Mobile number" name="mobile_number" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" placeholder="Confirm password" name="C_password" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="text" placeholder="Enter Your Address" name="address" maxlength="20" required>
                        </div>
                        <!-- <div class="input-group radio">
                            <input type="radio" name="role" value="Customer" required>
                            <label>Customer</label>
                            <input type="radio" name="role" value="Service Provider" required>
                            <label>Service Provider</label>
                        </div> -->

                        <div class="input-group radio">
                            <input type="radio" name="role" value="Customer" id="customerRadio" required>
                            <label for="customerRadio">Customer</label>
                            <input type="radio" name="role" value="Service Provider" id="serviceProviderRadio" required>
                            <label for="serviceProviderRadio">Service Provider</label>
                        </div>

                        <div id="serviceProviderOptions" class="hiddenServices">
                            <h3>How would you serve:</h3>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="ServiceType" value="Individual"> Individual
                                </label>
                                <label>
                                    <input type="radio" name="ServiceType" value="Business"> Business
                                </label>
                            </div>
                        </div>

                        <input class="submit" type="submit" value="Sign up" name="SignUp">

                        <p>
                            <span>
                                Already have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign in here
                            </b>
                        </p>
                    </form>
                </div>

            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <form action="registration.php" method="post" class="form sign-in">
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="number" placeholder="Mobile number" name="mobile_number" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" placeholder="Password" name="password" required>
                        </div>

                        <div class="captcha-field input-group">

                            <div class="generate-captcha">
                                <p id="captcha"></p>
                                <i class="fa-solid fa-rotate" id="captcha-refresh" style="color: #000;"></i>
                            </div>

                            <input type="text" name="captcha_input" id="captcha-input" placeholder="Enter Captcha" required>
                        </div>

                        <input class="submit" type="submit" value="Sign in" name="submit">

                        <p>
                            <b>
                                Forgot password?
                            </b>
                        </p>
                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
                            </b>
                        </p>
                    </form>
                </div>
                <div class="form-wrapper">

                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>

                </div>
                <div class="img sign-in">

                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">

                </div>
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>

                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>


    <script>
        let container = document.getElementById('container')

        toggle = () => {
            container.classList.toggle('sign-in')
            container.classList.toggle('sign-up')
        }

        setTimeout(() => {
            container.classList.add('sign-in')
        }, 200)


        function captchaGeneration() {
            setTimeout(() => {
                captcha = document.getElementById("captcha");

                let fetchSourceData = new XMLHttpRequest();
                fetchSourceData.open('GET', 'captcha-refresh.php?v=true', true);
                fetchSourceData.send();

                fetchSourceData.onreadystatechange = (() => {
                    if (fetchSourceData.readyState == 4 && fetchSourceData.status == 200) {
                        captcha.innerHTML = fetchSourceData.responseText;
                    }
                })
            }, 300);
        }
        let captcha = document.getElementById("captcha-refresh").addEventListener('click', function() {
            captchaGeneration();
            document.getElementById("captcha-refresh").classList.toggle('refresh-icon');
            setTimeout(() => {
                document.getElementById("captcha-refresh").classList.remove('refresh-icon');
            }, 700);
        })

        captchaGeneration();


        document.addEventListener('DOMContentLoaded', function() {
            const serviceProviderRadio = document.getElementById('serviceProviderRadio');
            const customerRadio = document.getElementById('customerRadio');
            const serviceProviderOptions = document.getElementById('serviceProviderOptions');

            serviceProviderRadio.addEventListener('change', function() {
                if (serviceProviderRadio.checked) {
                    serviceProviderOptions.classList.remove('hiddenServices');
                }
            });

            customerRadio.addEventListener('change', function() {
                if (customerRadio.checked) {
                    serviceProviderOptions.classList.add('hiddenServices');
                }
            });
        });
    </script>
</body>

</html>