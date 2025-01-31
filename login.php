<?php
require 'config.php';

if(isset($_SESSION['username'])) header('location: admin_dashboard.php');
if(isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $search = $conn->query("SELECT * FROM users WHERE username = '$user' AND password = '$pass'");
    if($search->num_rows > 0) {
        $row = $search->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        header('location: admin_dashboard.php');
    } else {
        echo '<script>alert("Username atau password salah")</script>';
    }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login - LSP JWP Wedding Organizer</title>
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
                background-color: #94FFD8;
                padding: 30px 30px;
            }
            .tulisan-navbar{
                margin: 0 auto;
                color:white;
            }
            .navbar-brand {
                position: absolute;
                left: 0;
                margin-left: 40px;
                margin-top: 0px;
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
        <header>
            <div class="navbar">
                <a class="navbar-brand" href="index.php">
                    <img src="img/home.png" alt="Home" width="40" height="40">
                </a>
                <h1 class="tulisan-navbar">Admin Login</h1>
            </div>
        </header>


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body mt-5 mb-5">
                        <h2 class="text-center">Login</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Login</button>
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