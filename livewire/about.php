<!DOCTYPE html>
<html lang="en">
<head>
    <title>About | Livewire Planet Suites</title>
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

<!-- About Us Section -->
<div class="container" style="text-align:center; margin:40px auto;">
    <h1 style="font-weight:bold;">ABOUT US</h1>
    <br>

    <!-- Flexbox Wrapper -->
    <div style="display:flex; justify-content:center; align-items:center; gap:50px; flex-wrap:wrap;">

        <!-- Text -->
        <div style="flex:1; min-width:300px; max-width:600px; text-align:justify;">
            <p style="font-size:20px; line-height:1.7;">
                <b>Livewire Planet Suites</b>, in Corner Santos Street, General Santos City offers family rooms with air-conditioning, private bathrooms, and free toiletries. Each room includes a work desk, TV, and tiled floors.
            </p>
            <p style="font-size:20px; line-height:1.7;">
                Guests can relax on the terrace or balcony with city views. The hotel features a ground-floor unit on a quiet street, providing a peaceful environment.
            </p>
            <p style="font-size:20px; line-height:1.7;">
                The property provides a <b>24-hour front desk, room service, and free on-site private parking.</b> Then additional they have also <b>Amenities and Facilities</b> in the hotel.
            </p>
            <p style="font-size:20px; line-height:1.7;">
                Then <b>General Santos International Airport is 12 km away, offering easy travel connections.</b> This makes it a convenient choice for travelers seeking comfort and accessibility in General Santos City.
            </p>
        </div>

        <!-- Image -->
        <div style="flex:1; min-width:300px; max-width:500px; text-align:center;">
            <img src="assets/images/Suites.png" alt="Livewire Suites" 
                 style="width:100%; max-width:500px; height:auto; border-radius:10px; box-shadow:0 0 50px rgba(0,0,0,0.2);" />
        </div>
    </div>
</div>

<hr style="border:1px dotted #000; width:80%;" />

<!-- Footer -->
<footer>
    <h4>&copy; All Rights Reserved | Livewire Planet Suites</h4>
</footer>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
