<?php
require 'config.php';

if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $service_result = $conn->query("SELECT * FROM services WHERE id = $service_id");

    if ($service_result->num_rows > 0) {
        $service = $service_result->fetch_assoc();
    } else {
        echo "Service not found.";
        exit;
    }
} else {
    echo "No service selected.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $event_date = $_POST['event_date'];

    $services_name = $_POST['services_name'];

    $sql = "INSERT INTO orders (customer_name, email, event_date, status, services_name) VALUES ('$customer_name', '$email', '$event_date', 'Requested', '$services_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
</head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wedding Organizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <style>

            @font-face {
                font-family: 'Agency Gothic CT';
                src: url('assets/css/agency/AgencyGothicCT-Medium.woff');
            }

            .navbar {
                background-color: #7EDAE7;
                padding: 30px 30px;
            }

            .navbar-nav .nav-link {
                font-family: 'Verdana';
                font-weight: bold;
                color: #343a40; 
                font-size: 24px;
                margin-right: 0px;
            }

            .navbar .navbar-brand {
                font-family: 'Agency Gothic CT';    
                font-weight: bold;
                position: absolute;
                right: 0;
                font-size: 24px;
                margin-right: 50px;
                margin-top: -40px;
            }

            .nav-item {
                margin: 0px 1rem 0px 1rem;
                padding-left: 1px;
                padding-right: 1px;
            }

            .nav-item:hover {
                background-image: url(img/flower.jpg);
                border-radius: 6px;
            }

            .body-order{
                margin-top: 20px;
            }
            .kotak-login{
                position: absolute;
                right: 0;
                margin-right: 50px;
                margin-top: 55px;
                background-color: #3ABE4E;
                text-align: center;
                justify-content: center;
                width: 150px;
                height: 30px;
                border-radius: 10px;
            }

            .navbar-text{
                margin-top: -5px;
                text-align: center;
                justify-content: center;
                text-decoration: none;
                color: #fff
            }

            .kotak-login img {
                margin-top: -5px;
                display: inline-block;
                width: 20px;
                height: 20px;
                margin-right: 5px;
                vertical-align: middle;
            }

            .kotak-login .navbar-text {
                display: inline-block;
                vertical-align: middle;
            }

            .navbar-nav{
                margin-left: 40px;
            }

            /* Body */
            .tulisan-hero {
                margin: 0 auto;
            }

            .hero-header {
                padding-bottom: 20px;
            }

            .tulisan-tengah h3 span {
                color: red;
            }

            .text-merah {
                color: red;
            }

            .text-putih {
                color: wheat;
            }

            .tengah {
                padding-bottom: 20px;
            }

            .tengah2 {
                padding-bottom: 20px;
            }

            .isi-hero {
                color: white;
                font-weight: bold;
                font-size: 20px;
            }

            footer {
                background: #333;
                color: #fff;
                text-align: center;
                padding: 1em 0;
            }

            footer p {
                margin: 0;
            }
        </style>
</head>
<body>
    <div class="container body-order">
        <a href="katalog.php">
            <img src="img/back.png" alt="Back" width="40" height="40">
        </a>
        <h2 class="mt-4">Order <?php echo $service['name']; ?></h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
           
            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required>
            </div>
            <input type="hidden" name="services_name" value="<?php echo ($service['name']); ?>">
            <button type="submit" class="btn btn-primary">Pesan</button>
        </form>
    </div>
</body>
</html>
