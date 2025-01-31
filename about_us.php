<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home - Wedding Organizer</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <style>

            html, body {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            
            @font-face {
                font-family: 'Roboto', sans-serif;
                src: url('assets/css/agency/AgencyGothicCT-Medium.woff');
            }

            .navbar {
                background-color: #0056b3;
                padding: 30px 30px;
            }

            .navbar-nav .nav-link {
                font-family: 'Roboto', sans-serif;
                color: white; 
                font-size: 24px;
                margin-right: 0px;
            }

            .navbar .navbar-brand {
                font-family: 'Roboto', sans-serif;   
                color: white; 
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

            .kotak-login{
                position: absolute;
                right: 0;
                margin-right: 50px;
                margin-top: 55px;
                background-color: lightblue;
                text-align: center;
                justify-content: center;
                width: 150px;
                padding: 5px;
                border-radius: 10px;
                text-decoration: none;
                color: white;
            }

            .kotak-login:hover{
                background-color: #2EE141;
                color: white;
            }

            .kotak-login img {
                margin-top: -4px;
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
            .text-center{
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .btn-pesan{
                background-color: green;
                color: white;
                padding: 7px 8px;
                border-radius: 5px;
                border: none;
                text-decoration: none;
            }

            .btn-pesan:hover{
                background-color: #24EF39;
                text-decoration: none;
                color: white;
            }

            .btn-detail{
                background-color: #2096B9;
                color: white;
                padding: 5px 8px;
                border-radius: 5px;
                margin-left: 6px;
                border: none;
            }
            .btn-detail:hover{
                background-color: #60D9D0;
                color: white;
            }

            .card-text {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3; /* Number of lines to show */
                -webkit-box-orient: vertical;
            }

            .custom-img{
                height: 200px;
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
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">
                Wedding Organizer</a>
                <a class="kotak-login" href="login.php">
                    <img src="img/account.png" alt="Admin Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                    Admin Login
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="katalog.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php">About Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <section class="kontak-header">
            <div class="container-fluid py-5" style="background-image: url(img/wedding.png); background-position: center; background-repeat: no-repeat;">
                <div class="row kontak">
                    <h1 class="judul-konten"style="color:white">About Us</h1>
                    <p class="isi-profile" style="color:white">
                     Kami siap membantu Anda merencanakan hari istimewa dengan penuh cinta dan keahlian. Temukan berbagai layanan kami dan biarkan kami mewujudkan pernikahan impian jika membutuhkan silangkan hubungi kontak kami di bawah ini
                    </p>
                    <p class="isi-profile"style="color:white">
                    
                    </p>
                </div>
                <p style="color: white;">No Telp : (081289240454)</p>
                <p style="color: white;">Email : (syahreza321@gmail.com)</p>
            </div>
        </section>
        </body>
        <footer>
            <div class="container">
                <p>&copy; 2024 Wedding Organizer. All rights reserved.</p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>