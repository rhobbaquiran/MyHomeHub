<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHomeHub</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Googlefont Poppins CDN Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .btn-outline-secondary {
            color: #fafafa;
            border-color: #fff; 
        }

        .btn-outline-secondary:hover {
            color: #000; 
            background-color: #fafafa; 
            border-color: #fafafa; 
        }

        .ul.navbar-nav .nav-item.active a {
            font-weight: bold;
        }

        .welcome {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(../myhomehub/includes/images/condominium_home_page.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            padding: 300px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome h1, .welcome p {
            color: #fafafa;
            padding: 10px;
        }

        .welcome h1 {
            font-size: 65px;
        }

        .welcome p {
            font-size: 25px;
        }

        @media (max-width: 768px) {
            .welcome {
                padding-top: 50px;
                padding-bottom: 50px; 
            }
        }

        footer {
            background-color: #084cb4;
            color: #fafafa;
            padding: 5px 0; 
        }

        .footer-icons a {
            color: #fafafa;
            margin-right: 10px;
            font-size: 20px; 
        }

        .footer-icons a:hover {
            color: #ccc;
        }

        .footer-heading {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .footer-copyright {
            text-align: center;
            font-size: 12px; 
            color: #fafafa;
        }

        .footer-link {
            text-align: left;
        }

        .follow-us-icon {
            color: #fafafa;
        }
</style>
</head>
<body>
    <nav id="navbar "class="navbar navbar-dark navbar-expand-lg" style="background-color: #084cb4;">
    <a class="navbar-brand" href="home_page.php">
        <img src="includes/logo.png" width="50" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="navbar-item active">
                <a class="nav-link" href="home_page.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact_us.php">Contact Us</a>
            </li>
        </ul>
        <a id="loginButton" class="btn btn-outline-secondary my-2 my-sm-0" href="index.php">Log In</a>
    </div>
    </nav>

    <div class="welcome">
        <h1>Welcome to MyHomeHub</h1>
        <p>Residential Management System</p>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <!-- Services Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 17px;">Services</h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="services.php" class="footer-link" style="color: #fafafa; text-decoration: none;">Residential Management System</a></li>
                    </ul>
                </div>
                <!-- Help Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 17px;">Help</h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="about.php" class="footer-link" style="color: #fafafa; text-decoration: none;">About</a></li>
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="contact_us.php" class="footer-link" style="color: #fafafa; text-decoration: none;">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Follow Us Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 16px;">Follow Us</h5>
                    <ul class="list-unstyled footer-icons">
                        <li style="display: inline-block;"><a href="#"><i class="fab fa-facebook follow-us-icon"></i></a></li>
                        <li style="display: inline-block;"><a href="#"><i class="fab fa-twitter follow-us-icon"></i></a></li>
                        <li style="display: inline-block;"><a href="#"><i class="fab fa-linkedin follow-us-icon"></i></a></li>
                        <li style="display: inline-block;"><a href="#"><i class="fab fa-instagram follow-us-icon"></i></a></li>
                        <li style="display: inline-block;"><a href="#"><i class="fab fa-youtube follow-us-icon"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- Horizontal line -->
            <div class="row justify-content-center mt-3" style="margin-bottom: -30px;">
                <div class="col-md-6">
                    <hr style="border-top: 1px solid #fafafa;">
                </div>
            </div>
            <!-- Copyright -->
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <p class="footer-copyright" style="margin-top: 5px;">&copy; 2024 MyHomeHub. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript (Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Select the navbar element
        var navbar = document.getElementById('navbar');

        // Function to toggle navbar visibility
        function toggleNavbar() {
            if (window.scrollY > 50) {
                navbar.style.display = 'block';
            } else {
                navbar.style.display = 'none';
            }
        }

        // Listen for scroll events and call toggleNavbar function
        window.addEventListener('scroll', toggleNavbar);
    </script>

    <!--To put footer at the end of scroll-->
    <script>
        window.addEventListener('scroll', function() {
            var footer = document.getElementById('footer');
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                footer.style.display = 'block';
            } else {
                footer.style.display = 'none';
            }
        });
    </script>
</body>
</html>