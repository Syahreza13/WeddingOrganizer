<?php
require 'config.php';

if(!isset($_SESSION['username'])) header('location: login.php');

if(isset($_GET['delete'])) {
    $service = mysqli_real_escape_string($conn, $_GET['delete']);
    $search = $conn->query("SELECT * FROM services where id ='$service'");
    if($search->num_rows == 1){
        $data = $search->fetch_assoc();
        if($conn->query("DELETE FROM services WHERE id = '$service'")) {
            unlink('img/service/'.$data['img']);
            if($conn->query("SELECT COUNT(id) AS x FROM services")->fetch_assoc()['x'] == 0)
                $conn->query("ALTER TABLE services AUTO_INCREMENT = 1");
            echo '<script>alert("Service deleted successfully.")</script>';
        } else {
            echo '<script>alert("Failed to delete service.")</script>';
        }
    }else{
        echo '<script>alert("Service not found.")</script>';
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kelola Katalog - LSP JWP Wedding Organizer</title>
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
                background-color: #FF204E;
                padding: 30px 30px;
            }
            .tulisan-navbar{
                margin: 0 auto;
                color:white;
            }
            .navbar-brent {
                position: absolute;
                left: 0;
                margin-left: 40px;
                margin-top: 0px;
            }

            .navbar .navbar-brand {
                font-family: 'Roboto', sans-serif;   
                color: white; 
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
                <h2 class="tulisan-navbar">Kelola Katalog</h1>
                <a class="navbar-brand" href="#">Wedding Organizer</a>
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
                        <h2 class="text-center">Kelola</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Harga</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <?php
                                $services = $conn->query("SELECT * FROM services");
                                while($row = $services->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['note']) ?></td>
                                    <td><?= htmlspecialchars($row['harga']) ?></td>
                                    <td><img src="img/service/<?= htmlspecialchars($row['img']) ?>" width="100" /></td>

                                    <td>
                                        <a href="edit_service.php?id=<?= htmlspecialchars($row['id']) ?>">Edit</a>
                                        <a href="kelola_katalog.php?delete=<?= htmlspecialchars($row['id']) ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="add_service.php" class="btn btn-primary" style="background-color:red">Tambah Katalog</a>
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