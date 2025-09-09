<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Livewire Planet Suites</title>
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

        /* Carousel image fix */
        .carousel-inner .item img {
            width: 100%;
            height: 950px;
            object-fit: cover;
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

<?php include 'db_connect.php'; ?>
<br />
<div class="container" style="text-align:center; margin:0 auto;">
    <h3 style="font-weight:bold;">WELCOME TO LIVEWIRE PLANET SUITES</h3>
</div>
<br style="clear:both;"/>

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

<!-- Carousel -->
<div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>
    <div style="margin:auto;" class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="assets/images/Liveswire.jpg" />
        </div>
        <div class="item">
            <img src="assets/images/Suites.png" />
        </div>
        <div class="item">
            <img src="assets/images/Deluxe.jpg" />
        </div>
        <div class="item">
            <img src="assets/images/Matrimonial.jpg" />
        </div>
        <div class="item">
            <img src="assets/images/Twin Bed.jpg" />
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>    
</div>

<br style="clear:both;"/>
<br />
<br />

<!-- Footer -->
<footer>
    <h4>&copy; All Rights Reserved | Livewire Planet Suites</h4>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
