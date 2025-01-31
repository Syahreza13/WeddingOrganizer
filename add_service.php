<?php
require 'config.php';

if(!isset($_SESSION['username'])) header('location: login.php');
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $image = $_FILES['image'];

    $insert = $conn->query("INSERT INTO services (name, note, harga, img) VALUES ('$name', '$note', '$harga', '{$image['name']}')");
    if($insert){
        move_uploaded_file($image['tmp_name'], 'img/service/'.$image['name']);
        header('location: kelola_katalog.php');
    } 
    else echo '<script>alert("'.$conn->error.'")</script>';
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tambah Katalog - JeWePe Wedding Organizer</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <style>
            
            html, body {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
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
                color: black;
                font-weight: bold;
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
                <h2 class="tulisan-navbar">Tambah Katalog</h1>
                <a class="navbar-brand" href="admin_dashboard.php">JeWePe Wedding Organizer</a>
                <div class="kotak-login">
                    <span class="navbar-text"><?php echo $_SESSION['username']; ?></span>
                    <a href="logout.php">
                        <img src="img/logout.png" alt="Logout" width="40" height="40">
                    </a>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body mt-5 mb-5">
                        <h2 class="text-center">Tambah</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="note" name="note" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <textarea class="form-control" id="harga" name="harga" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <a href="kelola_katalog.php" class="btn btn-warning">Back</a>
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>&copy; 2024 Wedding Organizer. All rights reserved.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>