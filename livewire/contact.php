<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact | Livewire Planet Suites</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style>
        /* Sticky Navigation Styling */
        nav {
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        nav ul {
            list-style: none;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 30px;
            font-size: 20px;
        }
        nav ul li {
            position: relative;
        }
        nav ul li a {
            color: #337ab7;
            text-decoration: none;
            font-weight: 500;
            font-size: 22px;
            padding: 8px 5px;
            transition: color 0.3s ease;
        }
        /* Hover underline animation */
        nav ul li a::after {
            content: "";
            position: absolute;
            width: 0;
            height: 3px;
            left: 0;
            bottom: 0;
            background: #337ab7;
            transition: width 0.3s ease;
        }
        nav ul li a:hover::after {
            width: 100%;
        }
        nav ul li a:hover {
            color: #23527c;
        }

        /* Contact Section */
        .contact-card {
            max-width: 600px;
            margin: 40px auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
        }
        .contact-card img {
            border-radius: 10px;
            margin-bottom: 20px;
            max-width: 100%;
            height: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        .contact-card p {
            font-size: 18px;
            margin: 8px 0;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background: #f8f8f8;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Page Title -->
<div class="container" style="text-align:center; margin:20px auto;">
    <h3 style="font-weight:bold;">WELCOME TO LIVEWIRE PLANET SUITES</h3>
</div>

<!-- Navigation -->
<nav>
    <ul>
        <li><a href="home.php">HOME</a></li>|
        <li><a href="about.php">ABOUT US</a></li>| 
        <li><a href="amenities.php">AMENITIES & FACILITIES</a></li>|
        <li><a href="contact.php">CONTACT US</a></li>| 
        <li><a href="reservation.php">BOOK NOW!</a></li>|
    </ul>
</nav>

<!-- Contact Us Section -->
<div class="container">
    <div class="contact-card">
        <h2 style="font-weight:bold; margin-bottom:20px;">CONTACT US</h2>
        <img src="images/hotel.jpg" alt="Hotel" width="300" height="300" />
        <p><b>Contact No:</b> +639999999999</p>
        <p><b>Email:</b> rooms@hotel.com</p>
    </div>
</div>

<!-- Footer -->
<footer>
    <h4>&copy; All Rights Reserved | Livewire Planet Suites</h4>
</footer>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
