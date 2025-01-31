<?php
require 'config.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if(!isset($_SESSION['username'])) header('location: login.php');

// Query to get the order data
$orders_query = "SELECT orders.order_id, customer_name, email, event_date, services_name, status
                 FROM orders
                 ORDER BY orders.order_id ASC";

$orders = $conn->query($orders_query);

if ($orders === false) {
    die("Error: " . $conn->error);
}

// Generate the HTML content for the PDF
$html = '<h2>Order List</h2>';
$html .= '<table border="1" cellpadding="10">';
$html .= '<thead>
            <tr>
                <th>Order ID</th>
                <th>Nama Kustomer</th>
                <th>Email</th>
                <th>Tanggal</th>
                <th>Nama Paket</th>
                <th>Status</th>
            </tr>
          </thead>';
$html .= '<tbody>';

while ($order = $orders->fetch_assoc()) {
    $html .= '<tr>
                <td>' . htmlspecialchars($order['order_id']) . '</td>
                <td>' . htmlspecialchars($order['customer_name']) . '</td>
                <td>' . htmlspecialchars($order['email']) . '</td>
                <td>' . htmlspecialchars($order['event_date']) . '</td>
                <td>' . htmlspecialchars($order['services_name']) . '</td>
                <td>' . htmlspecialchars($order['status']) . '</td>
              </tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Initialize dompdf and generate the PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("orders.pdf", array("Attachment" => false));
