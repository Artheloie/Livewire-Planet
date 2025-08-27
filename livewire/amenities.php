<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hotel Online Reservation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<nav style="background-color:rgba(0, 0, 0, 0.1);" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header" style="width:100%; text-align:center;">
            <h1 style="margin:0;">
                <b>
                    <a class="navbar-brand" 
                       style="display:inline-block; float:none; text-transform: uppercase; font-weight: bold; font-size:32px;">
                        LIVEWIRE PLANET SUITES
                    </a>
                </b>
            </h1>
        </div>
    </div>
</nav>

    <!-- Menu -->
    <ul id="menu">
        <li><a href="index.php">Home</a></li> |
        <li><a href="about.php">About us</a></li> |
        <li><a href="amenities.php">Amenities & Facilities</a></li> |
        <li><a href="contact.php">Contact us</a></li> |
        <li><a href="reservation.php">Make a reservation</a></li> |
    </ul>

    <!-- Amenities Section -->
    <div class="container" style="text-align:center; margin:0 auto;">
        <h1 style="font-weight:bold;">AMENITIES & FACILITIES</h1>
        <br>

        <!-- Flexbox Wrapper -->
        <div style="display:flex; justify-content:center; align-items:flex-start; gap:50px; flex-wrap:wrap; text-align:left;">

            <!-- Column 1 -->
            <div style="flex:1; min-width:300px; max-width:400px;">
                <h3><b>Languages spoken</b></h3>
                <ul>
                    <li>English</li>
                    <li>Filipino</li>
                </ul>

                <h3><b>Internet access</b></h3>
                <ul>
                    <li>Free Wi-Fi in all rooms!</li>
                    <li>Internet</li>
                    <li>Internet services</li>
                </ul>

                <h3><b>Access</b></h3>
                <ul>
					<li>Check-in [24-hour]</li>
                    <li>Front desk [24-hour]</li>
                    <li>Non-smoking rooms</li>
                    <li>Room service</li>
                </ul>
            </div>

            <!-- Column 2 -->
            <div style="flex:1; min-width:300px; max-width:400px;">
                <h3><b>Cleanliness and safety</b></h3>
                <ul>
                    <li>Body thermometer</li>
                    <li>Doctor/nurse on call</li>
                    <li>First aid kit</li>
                    <li>Hand sanitizer</li>
                    <li>Shared stationery removed</li>
                    <li>Staff trained in safety protocol</li>
                    <li>Temperature check for guests and staff</li>
                </ul>

                <h3><b>Services and conveniences</b></h3>
                <ul>
                    <li>Air conditioning in public area</li>
                    <li>Daily housekeeping</li>
                    <li>Safety deposit boxes</li>
                    <li>Smoke-free property</li>
                    <li>Smoking area</li>
                    <li>Terrace</li>
                </ul>
            </div>

            <!-- Column 3 -->
            <div style="flex:1; min-width:300px; max-width:400px;">
                <h3><b>For the kids</b></h3>
                <ul>
                    <li>Family/child friendly</li>
                    <li>Family room</li>
                </ul>

                <h3><b>Getting around</b></h3>
                <ul>
                    <li>Airport transfer</li>
                    <li>Car park [free of charge]</li>
                    <li>Car park [on-site]</li>
                </ul>
  
                <h3><b>Available in all rooms</b></h3>
                <ul>
                    <li>Air conditioning</li>
                    <li>Fan</li>
                    <li>Internet access – wireless</li>
                    <li>Non-smoking</li>
                    <li>Satellite/cable channels</li>
                    <li>Shower</li>
                    <li>Smoke detector</li>
                    <li>Toiletries</li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    <hr style="border:1px dotted #000;" />
    <br><br>

    <!-- Footer -->
    <div style="text-align:center;">
        <h3><label>&copy; All Rights in Livewire Planet Suites</label></h3>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
