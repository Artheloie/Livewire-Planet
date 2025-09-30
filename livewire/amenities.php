<!DOCTYPE html>
<html lang="en">
<head>
    <title>Amenities | Livewire Planet Suites</title>
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

        /* Card Styling for amenities */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .card-body {
            padding: 15px;
            font-size: 18px;
            line-height: 1.6;
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
<?php
include 'db_connect.php';
$result = mysqli_query($conn, "SELECT description FROM amenities ORDER BY id DESC");
?>
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

<!-- Amenities Section -->
<div class="container" style="text-align:center; margin:40px auto;">
    <h1 style="font-weight:bold;">AMENITIES & FACILITIES</h1>
    <br>

    <div style="max-width:800px; margin:0 auto; text-align:left;">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <div class="card-body">
                        <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
        <?php } ?>
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
