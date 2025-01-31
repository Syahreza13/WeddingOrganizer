<?php
require 'config.php';

if(!isset($_SESSION['username'])) header('location: login.php');

if (isset($_GET['delete_order'])) {
    $order = mysqli_real_escape_string($conn, $_GET['delete_order']);
    $search = $conn->query("SELECT * FROM orders WHERE order_id ='$order'");
    if ($search->num_rows == 1) {
        $data = $search->fetch_assoc();
        if ($conn->query("DELETE FROM orders WHERE order_id = '$order'")) {
            $total_orders = $conn->query("SELECT COUNT(order_id) AS total_orders FROM orders")->fetch_assoc()['total_orders'];
            if ($total_orders == 1) {
                // Jika hanya ada satu data, atur auto-increment ke 1
                $conn->query("ALTER TABLE orders AUTO_INCREMENT = 1");
            }
            echo '<script>alert("Order deleted successfully.")</script>';
        } else {
            echo '<script>alert("Failed to delete order.")</script>';
        }
    } else {
        echo '<script>alert("Order not found.")</script>';
    }
}

if (isset($_GET['approve'])) {
    $order_id = mysqli_real_escape_string($conn, $_GET['approve']);

    // Ambil informasi order yang akan di-approve
    $approve_query = "SELECT orders.order_id, orders.customer_name, orders.email, orders.event_date, services.name AS services_name, services.harga
                    FROM orders
                    INNER JOIN services ON orders.services_name = services.name
                    WHERE orders.order_id ='$order_id'";
    $result = $conn->query($approve_query);

    if ($result->num_rows == 1) {
        $order_data = $result->fetch_assoc();

        try {

            $mail->isHTML(true);
            $mail->addAddress($order_data['email'], $order_data['customer_name']);
            $mail->Subject = 'Pemberitahuan Persetujuan Pesanan';

            $body = 'Kepada, ' . htmlspecialchars($order_data['customer_name']) . '<br><br>';
            $body .= 'Terima kasih telah memilih JeWePe Wedding Organizer untuk kebutuhan pernikahan Anda. Kami dengan senang hati menginformasikan bahwa pesanan Anda dengan nomor order ' . htmlspecialchars($order_data['order_id']) . ' telah disetujui.<br><br>';
            $body .= 'Paket Wedding yang Dipesan : ' . htmlspecialchars($order_data['services_name']) . '<br>';
            $body .= 'Tanggal Pernikahan : ' . htmlspecialchars($order_data['event_date']) . '<br>';
            $body .= 'Total Harga : Rp ' . htmlspecialchars($order_data['harga']) . '<br><br>';
            $body .= 'Terima kasih atas kepercayaan Anda menggunakan layanan kami. Kami berharap dapat membantu mewujudkan pernikahan impian Anda.<br><br>';
            $body .= 'Best regards,<br>';
            $body .= 'JeWePe Wedding Organizer';

            // Set email body
            $mail->Body = $body;

            // Kirim email
            $mail->send();
            $approve_query = "UPDATE orders SET status = 'Approved' WHERE order_id = '$order_id'";
            if ($conn->query($approve_query)) {
                echo '<script>alert("Order approved successfully. Email notification sent.")</script>';
            } else {
                echo '<script>alert("Failed to update order status.")</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Failed to send email notification: ' . $mail->ErrorInfo . '")</script>';
        }
    } else {
        echo '<script>alert("Order not found.")</script>';
    }
}

if (isset($_GET['reject'])) {
    $order_id = mysqli_real_escape_string($conn, $_GET['reject']);

    // Ambil informasi order yang akan di-reject
    $reject_query = "SELECT orders.order_id, orders.customer_name, orders.email, orders.event_date, services.name AS services_name, services.harga
                    FROM orders
                    INNER JOIN services ON orders.services_name = services.name
                    WHERE orders.order_id ='$order_id'";
    $result = $conn->query($reject_query);

    if ($result->num_rows == 1) {
        $order_data = $result->fetch_assoc();

        try {

            $mail->isHTML(true);
            $mail->addAddress($order_data['email'], $order_data['customer_name']);
            $mail->Subject = 'Pemberitahuan Penolakan Pesanan';

            $body = 'Kepada, ' . htmlspecialchars($order_data['customer_name']) . '<br><br>';
            $body .= 'Kami mohon maaf untuk menginformasikan bahwa pesanan Anda dengan nomor order ' . htmlspecialchars($order_data['order_id']) . ' telah ditolak.<br><br>';
            $body .= 'Paket Wedding yang Dipesan : ' . htmlspecialchars($order_data['services_name']) . '<br>';
            $body .= 'Tanggal Pernikahan : ' . htmlspecialchars($order_data['event_date']) . '<br><br>';
            $body .= 'Silakan hubungi kami untuk informasi lebih lanjut.<br><br>';
            $body .= 'Best regards,<br>';
            $body .= 'JeWePe Wedding Organizer';

            // Set email body
            $mail->Body = $body;

            // Kirim email
            $mail->send();
            $reject_query = "UPDATE orders SET status = 'Rejected' WHERE order_id = '$order_id'";
            if ($conn->query($reject_query)) {
                echo '<script>alert("Order rejected successfully. Email notification sent.")</script>';
            } else {
                echo '<script>alert("Failed to update order status.")</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Failed to send email notification: ' . $mail->ErrorInfo . '")</script>';
        }
    } else {
        echo '<script>alert("Order not found.")</script>';
    }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kelola Pesanan - Admin</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <style>

            html, body {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            .card {
                margin-top: 0px;
                border: none; /* Menghilangkan border pada card */
            }

            .navbar{
                background-color: #7EDAE7;
                padding: 30px 30px;
            }
            .tulisan-navbar{
                margin: 0 auto;
            }
            .navbar-brent {
                position: absolute;
                left: 0;
                margin-left: 40px;
                margin-top: 0px;
            }

            .navbar .navbar-brand {
                font-family: 'Agency Gothic CT';    
                font-weight: bold;
                color: black;
                position: absolute;
                right: 0;
                font-size: 24px;
                margin-right: 50px;
                margin-top: -40px;
            }

            .kotak-login{
                position: absolute;
                right: 0;
                margin-right: 50px;
                margin-top: 45px;
                background-color: #3ABE4E;
                text-align: center;
                justify-content: center;
                width: 140px;
                height: 30px;
                border-radius: 10px;
                display: flex;
            }

            .navbar-text{
                margin-top: -5px;
                text-align: center;
                justify-content: center;
                text-decoration: none;
                color: #fff;
                margin-right: 10px;
            }

            .kotak-login img {
                margin-top: 2px;
                display: inline-block;
                width: 17px;
                height: 17px;
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

            .btn{
                width: 80px;
            }

            .btn-approved{
                background-color: #28a745;
                color: #fff;
                border-color: #black;
                text-decoration: none;
                padding: 5px 8px;
                border-radius: 5px;
            }
            .btn-approved:hover{
                background-color: #99F834;
                color: #fff;
                text-decoration: none;
            }
            .btn-reject{
                background-color: #FB773C;
                color: #fff;
                border-color: #black;
                text-decoration: none;
                padding: 5px 8px;
                border-radius: 5px;
            }
            .btn-reject:hover{
                background-color: #FF8225;
                color: #fff;
                text-decoration: none;
            }

            .btn-delete{
                background-color: #dc3545;
                color: #fff;
                border-color: black;
                text-decoration: none;
                padding: 5px 8px;
                border-radius: 5px;
            }
            .btn-delete:hover{
                text-decoration: none;
                background-color: #F77E7E;
                color: #fff;
            }

            footer {
                background: #333;
                color: #fff;
                text-align: center;
                padding: 10px;
                margin-top: auto;
            }

            footer p {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <header class="sticky-top">
            <div class="navbar">
                <a class="navbar-brent" href="admin_dashboard.php">
                    <img src="img/home.png" alt="Home" width="40" height="40">
                </a>
                <h2 class="tulisan-navbar">Kelola Pesanan</h1>
                <a class="navbar-brand" href="#">JeWePe Wedding Organizer</a>
                <div class="kotak-login">
                    <span class="navbar-text"><?php echo $_SESSION['username']; ?></span>
                    <a href="logout.php">
                        <img src="img/logout.png" alt="Logout" width="40" height="40">
                    </a>
                </div>
            </div>
        </header>
            <div class="card card-body ">
                <h2 class="text-center">Pesanan</h2>
                <a href="export_pdf.php" class="btn btn-primary mb-3">Export</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Nama Kustomer</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Nama Paket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query untuk mengambil data orderan
                        $orders_query = "SELECT orders.order_id, customer_name, email, event_date, status, services_name
                                         FROM orders
                                         ORDER BY orders.order_id ASC";

                        $orders = $conn->query($orders_query);

                        // Debugging: Cek apakah query berhasil
                        if ($orders === false) {
                            echo "<tr><td colspan='6'>Error: " . $conn->error . "</td></tr>";
                        } else {
                            if ($orders->num_rows > 0) {
                                // Loop melalui hasil query
                                while ($order = $orders->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['email']) ?></td>
                            <td><?= htmlspecialchars($order['event_date']) ?></td>
                            <td><?= htmlspecialchars($order['services_name']) ?></td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td>
                                <?php if ($order['status'] != 'Approved' && $order['status'] != 'Rejected'): ?>
                                    <a href="pesanan.php?approve=<?= htmlspecialchars($order['order_id']) ?>" class="btn-approved">Approve</a>
                                    <a href="pesanan.php?reject=<?= htmlspecialchars($order['order_id']) ?>" class="btn-reject">Reject</a>
                                <?php endif; ?>
                                <a href="pesanan.php?delete_order=<?= htmlspecialchars($order['order_id']) ?>"class="btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php 
                                }
                            } else {
                                echo "<tr><td colspan='6'>No orders found.</td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <footer>
            <div class="container">
                <p>&copy; 2024 Wedding Organizer. All rights reserved.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>