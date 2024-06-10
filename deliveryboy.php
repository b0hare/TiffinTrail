<?php
include "databaseConnect.php";
session_start();

// Assuming the user is logged in and their mobile number is stored in the session
$mobileNumber = $_SESSION['user'];

// Fetch delivery man data from the database
$stmt = $conn->prepare("SELECT Id, Name, MNumber, Address, Vehicle FROM deliveryman WHERE MNumber = ?");
$stmt->bind_param("s", $mobileNumber);
$stmt->execute();
$stmt->bind_result($id, $name, $phone, $address, $vehicle);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Boy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="deliveryboy.css">

</head>

<body>
    <main class="container">
        <header>
            <nav class="d-flex align-items-center">
                <div class="left d-flex align-items-center">
                    <img src="https://lh3.googleusercontent.com/RgVqHSvDkg5Gw0_UaeklzrX2_eARmBpRxduqyw2uk54sSe9ErDJL-v6oIyefoxxRMnMhe1YZaoeJtDN9odZ1uo2miPtU=w1200-rw" width="50px" alt="tiffinLogo">
                    <h3 class="tertiary">Tiffin Trail</h3>
                </div>

                <i class="fas fa-user"></i>

                <div class="personal-info">
                    <div class="card-body">
                    <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-id-badge"></i> Name: <strong><?php echo htmlspecialchars($name); ?></strong>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-id-badge"></i> Id: <strong><?php echo htmlspecialchars($id); ?></strong>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-phone"></i> Phone: <strong><?php echo htmlspecialchars($phone); ?></strong>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-motorcycle"></i> Vehicle: <strong><?php echo htmlspecialchars($vehicle); ?></strong>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map-marker-alt"></i> Address: <strong><?php echo htmlspecialchars($address); ?></strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 class="lead display-1">Welcome!</h1>
        </header>

        <section id="first">
            <h2 class="secondary my-5"><i class="fas fa-truck"></i> Pending Deliveries</h2>

            <div class="delivery d-flex">

                <div class="item-card d-flex">
                    <img src="https://images.squarespace-cdn.com/content/v1/612d4825ee7c3b7ba3e215b7/1667458982443-N6XGU1PU7335QEMVUP7M/Delicious+food.png" alt="plan-img" onclick="toggleDetails(this)">
                    <div class="item-text">
                        <h4>Veg plan1</h4>
                        <p class="from">Pick-up Address: Chetakpuri, Gwalior</p>
                        <p class="to">Delivery Address: Thana Jhansi Road, Gwalior</p>
                    </div>
                </div>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d7160.1099514913!2d78.16846969210091!3d26.19488985832893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3976c440a74b22a9%3A0x777a439b0cbb0f70!2zUG9saWNlIFN0YXRpb24gLUpoYW5zaSBSb2FkLEd3YWxpb3IsIEpoYW5zaSBSb2FkLCBuZWFyIOCkquClh-Ckn-CljeCksOCli-CksiDgpKrgpILgpKosIENoYW5kcmEgV2FkbmksIEd3YWxpb3IsIE1hZGh5YSBQcmFkZXNo!3m2!1d26.1888579!2d78.1745947!4m5!1s0x3976c424abc55153%3A0xa83752be4179ecf1!2sChetakpuri%2C%20Lashkar%2C%20Gwalior%2C%20Madhya%20Pradesh!3m2!1d26.2012009!2d78.1728313!5e0!3m2!1sen!2sin!4v1717069071629!5m2!1sen!2sin" width="100%" height="50%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="delivery d-flex">

                <div class="item-card d-flex">
                    <img src="https://data.tibettravel.org/assets/images/Tibet-bhutan-tour/indian-food-in-Lhasa.jpg" alt="plan-img" onclick="toggleDetails(this)">
                    <div class="item-text">
                        <h4>Jain plan3</h4>
                        <p class="from">Pick-up Address: Victoria Market, Gwalior</p>
                        <p class="to">Delivery Address: Baijataal- Moti Mahal, Gwalior</p>
                    </div>
                </div>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d3579.6297438365577!2d78.16954471442497!3d26.208720142085607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3976c5d1d776f911%3A0x916f99b8552fabd5!2sVictoria%20Market%2C%20Phool%20Bagh%2C%20Lohiya%20Bazaar%2C%20Gwalior%2C%20Madhya%20Pradesh!3m2!1d26.2101914!2d78.1728351!4m5!1s0x3976c5df44fa047d%3A0xbc998325ad6756f9!2sBaijataal%2C%20Moti%20Mahal%20Road%2C%20Lashkar%2C%20Gwalior%2C%20Madhya%20Pradesh!3m2!1d26.2080336!2d78.1715354!5e0!3m2!1sen!2sin!4v1717070452711!5m2!1sen!2sin" width="100%" height="50%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </main>
    <script>
        function toggleDetails(element) {
            const parent = element.closest('.delivery');
            parent.classList.toggle('active');
        }

        document.querySelector('.fa-user').addEventListener('click', function() {
            const personalInfoCard = document.querySelector('.personal-info');
            personalInfoCard.classList.toggle("display-b");
        });
    </script>
</body>

</html>