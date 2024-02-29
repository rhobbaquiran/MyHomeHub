<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            color:#252525;
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

        @media (max-width: 768px) {
            .contact_details {
                padding-top: 50px;
                padding-bottom: 50px; 
            }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #084cb4;
            color: #fff;
            padding: 5px 0; 
        }

        .footer-icons a {
            color: #fff;
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
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #084cb4;">
        <a class="navbar-brand" href="home_page.php">
            <img src="includes/logo.png" width="50" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="navbar-item">
                    <a class="nav-link" href="home_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contact_us.php">Contact Us <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <a id="loginButton" class="btn btn-outline-secondary my-2 my-sm-0" href="index.php">Log In</a>
        </div>
    </nav>

    <div class="contact_details container mt-5" style="padding: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-4 d-flex">
                <div class="card text-center flex-fill" style="padding: 10px;">
                    <div class="card-body d-flex flex-column h-100">
                        <i class="fas fa-map-marker-alt fa-3x mb-3" style="color: #252525"></i>
                        <h5 class="card-title">Address</h5>
                        <br>
                        <p class="card-text">7434 Yakal Street, Barangay San Antonio, Makati City, 1203</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card text-center flex-fill" style="padding: 10px;">
                    <div class="card-body d-flex flex-column h-100">
                        <i class="fas fa-envelope fa-3x mb-3" style="color: #252525"></i>
                        <h5 class="card-title">Email</h5>
                        <br>
                        <p class="card-text"><b>Rhob Lester Baquiran</b></p>
                        <p class="card-text">202001102@iacademy.edu.ph</p>
                        <p class="card-text"><b>John Rommel Corales</b></p>
                        <p class="card-text">202001102@iacademy.edu.ph</p>
                        <p class="card-text"><b>Paul Ryan Lopez</b></p>
                        <p class="card-text">201901177@iacademy.edu.ph</p>
                        <p class="card-text"><b>Lee Aaron Tupaz</b></p>
                        <p class="card-text">201901376@iacademy.edu.ph</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card text-center flex-fill" style="padding: 10px;">
                    <div class="card-body d-flex flex-column h-100">
                        <i class="fas fa-phone fa-3x mb-3" style="color: #252525"></i>
                        <h5 class="card-title">Phone</h5>
                        <br>
                        <p class="card-text"><b>Rhob Lester Baquiran</b></p>
                        <p class="card-text">+63 929 353 0031</p>
                        <p class="card-text"><b>John Rommel Corales</b></p>
                        <p class="card-text">+63 947 186 4162</p>
                        <p class="card-text"><b>Paul Ryan Lopez</b></p>
                        <p class="card-text">+63 917 531 2918</p>
                        <p class="card-text"><b>Lee Aaron Tupaz</b></p>
                        <p class="card-text">+63 939 385 9177</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <!-- Services Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 17px; color: #fafafa">Services</h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="services.php" class="footer-link" style="color: #fafafa; text-decoration: none;">Residential Management System</a></li>
                    </ul>
                </div>
                <!-- Help Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 17px; color: #fafafa;">Help</h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="about.php" class="footer-link" style="color: #fafafa; text-decoration: none;">About</a></li>
                        <li style="margin-bottom: 10px; font-size: 13px;"><a href="contact_us.php" class="footer-link" style="color: #fafafa; text-decoration: none;">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Follow Us Column -->
                <div class="col-md-4 footer-column">
                    <h5 class="footer-heading" style="font-size: 16px; color: #fafafa">Follow Us</h5>
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
                    <hr style="border-top: 1px solid #fff;">
                </div>
            </div>
            <!-- Copyright -->
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <p class="footer-copyright" style="margin-top: 5px; color: #fafafa">&copy; 2024 MyHomeHub. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript (Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>