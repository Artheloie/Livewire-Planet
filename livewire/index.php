<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Livewire Planet Suites</title>
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
	<div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
		</ol>
		<div style = "margin:auto;" class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="assets/images/Liveswire.jpg" style = "width:1000%; height:750px;" />
			</div>
		
			<div class="item">
				<img src="assets/images/Suites.png" style = "width:1000%; height:750px;"  />
			</div>
		
			<div class="item">
				<img src="assets/images/Deluxe.jpg" style = "width:1000%; height:750px;" />
			</div>
		
			<div class="item">
				<img src="assets/images/Matrimonial.jpg" style = "width:1000%; height:750px;" />
			</div>

            <div class="item">
				<img src="assets/images/Twin Bed.jpg" style = "width:1000%; height:750px;" />
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
	<br />
	<br />
    <div class="container" style="text-align:center; margin:0 auto;">
    <h1 style="font-weight:bold;">WELCOME TO LIVEWIRE PLANET SUITES</h1>
    <h3 style="font-weight:bold;">These are the rooms of Livewire Planet Suites</h3>
    <br><br>

    <!-- Flexbox wrapper for room items -->
    <div style="display:flex; justify-content:center; gap:100px; flex-wrap:wrap;">

        <!-- Deluxe -->
        <div style="text-align:center; width:300px;">
            <img src="assets/images/Deluxe.jpg" alt="Deluxe Room" style="width:120%; height:500px; max-height:300px; object-fit:cover; border-radius:10px;">
            <h2 style="color:rgba(38, 0, 255, 1);">Deluxe</h2>
            <h4><label style="color:black;">₱ 800.00</label> per night</h4>
        </div>

        <!-- Matrimonial -->
        <div style="text-align:center; width:300px;">
            <img src="assets/images/Matrimonial.jpg" alt="Matrimonial Room" style="width:120%; height:500px; max-height:300px; object-fit:cover; border-radius:10px;">
            <h2 style="color:rgba(38, 0, 255, 1);">Matrimonial</h2>	
            <h4><label style="color:black;">Php. 950.00</label> per night</h4>
        </div>

        <!-- Twin Bed -->
        <div style="text-align:center; width:300px;">
            <img src="assets/images/Twin Bed.jpg" alt="Twin Bed Room" style="width:120%; height:500px; max-height:300px; object-fit:cover; border-radius:10px;">
            <h2 style="color:rgba(38, 0, 255, 1);">Twin Bed</h2>
            <h4><label style="color:black;">Php. 1,000.00</label> per night</h4>
        </div>
    </div>
</div>
				<br style = "clear:both;"/>
				<br />
				<br />
                <hr style = "border:1px dotted #000;" />
				<br />
				<br />
	<div style = "text-align:center; margin-center:center;">
		<h3><label>&copy; All Rights in Livewire Planet Suites</label></h3>
	</div>
</body>
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>	
</html>






