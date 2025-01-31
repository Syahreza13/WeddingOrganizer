<?php
session_start();

$db = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'weddingorganizer'
];
$conn = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
if(!$conn) die('Koneksi gagal: '.mysqli_connect_error());

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Sesuaikan path sesuai struktur proyek Anda

$mail = new PHPMailer(true);

try {
    // Setup SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Ganti dengan alamat SMTP Anda
    $mail->SMTPAuth = true;
    $mail->Username = 'syahreza321@gmail.com'; // Ganti dengan username SMTP Anda
    $mail->Password = 'mfqtdujfncfwlcyz'; // Ganti dengan password SMTP Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Aktifkan enkripsi TLS
    $mail->Port = 587; // Port TCP untuk koneksi

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Pengaturan email
    $mail->setFrom('ariqnauf97@gmail.com'); // Alamat email pengirim dan nama
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}