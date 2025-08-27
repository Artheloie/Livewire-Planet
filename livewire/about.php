<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Hotel Online Reservation</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
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
	<ul id = "menu">
		<li><a href = "index.php">Home</a></li> |
		<li><a href = "about.php">About us</a></li> |
		<li><a href = "amenities.php">Amenities & Facilities</a></li> |
		<li><a href = "contact.php">Contact us</a></li> |			
		<li><a href = "reservation.php">Make a reservation</a></li> |
	</ul>
	<!-- About Us Section -->
    <div class="container" style="text-align:center; margin:0 auto;">
        <h1 style="font-weight:bold;">ABOUT US</h1>
        <br>

        <!-- Flexbox Wrapper -->
        <div style="display:flex; justify-content:center; align-items:center; gap:50px; flex-wrap:wrap;">

            <!-- Text -->
            <div style="flex:1; min-width:300px; max-width:600px; text-align:justify;">
                <p style="font-size:20px; line-height:1.7;">
                    <b>Livewire Planet Suites</b>, in General Santos City offers family rooms with air-conditioning, private bathrooms, and free toiletries. Each room includes a work desk, TV, and tiled floors.
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
                <img src="assets/images/Suites.png" alt="Livewire Suites" style="width:300%; max-width:600px; height:auto; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.2);" />
            </div>
        </div>
    </div>

    <br><br>
    <hr style="border:1px dotted #000;" />
    <br><br>

    <!-- Footer -->
    <div style = "text-align:center; margin-center:center;">
		<h3><label>&copy; All Rights in Livewire Planet Suites</label></h3>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
