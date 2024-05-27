<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiffinTrailPayment</title>

    <style>

        body{
            height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-gateway {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        .payment-gateway img {
            position: absolute;
            top: 10px;
            right: 30px;
            width: 100px;
            height: 100px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            width: 65%;
        }

        .payment-gateway form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
            background-color: #fff;
        }

        textarea {
            resize: vertical;
        }

        .confirm-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            align-self: center;
            transition: all .2s ease-in-out;
        }

        .confirm-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="payment-gateway">
        <?php

        include("databaseConnect.php");
        session_start();

        $pCode = $_SESSION["plan_code"];
        // $pCode = 3;

        // Prepare the query to prevent SQL injection
        $stmt = $conn->prepare("SELECT p.`user_id`, p.`plan_name`, p.`WeeklyPrice`, p.`MonthlyPrice`, p.`p_Description`, p.`url`, u.`First_Name`, u.`Last_Name`
            FROM `plan` p
            JOIN `users` u ON p.`user_id` = u.`Id`
            WHERE p.`code` = ?");
        $stmt->bind_param("i", $pCode);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the plan details
        $planDetail = $result->fetch_assoc();
        ?>
        <h2>Payment Gateway</h2>
        <form id="payment-form" method="post">
            <div class="form-group">
                <label for="plan-name">Plan Name</label>
                <input type="text" id="plan-name" name="plan-name"  value="<?php echo htmlspecialchars($planDetail['plan_name']); ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="plan-by">Plan By</label>
                <input type="text" id="plan-by" name="plan-by" value="<?php echo htmlspecialchars($planDetail['First_Name'] . ' ' . $planDetail['Last_Name']); ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="price">Select Price</label>
                <select id="price" name="price" required>
                    <option value="" disabled selected>Select Price</option>
                    <option value="WeeklyPrice">Weekly ₹<?php echo htmlspecialchars($planDetail['WeeklyPrice']); ?></option>
                    <option value="MonthlyPrice">Monthly ₹<?php echo htmlspecialchars($planDetail['MonthlyPrice']); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" readonly required><?php echo htmlspecialchars($planDetail['p_Description']); ?></textarea>
            </div>
            <button type="submit" class="confirm-button">Confirm Payment</button>
        </form>
        <img src="<?php echo htmlspecialchars($planDetail['url']); ?>" alt="Plan Image">
        <?php

        // Close the statement and connection
        $stmt->close();
        ?>
    </div>

    <script>

        function confirmed() {
            console.log("PaymentConfirm");
        }
    </script>
</body>

</html>