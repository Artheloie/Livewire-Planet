<?php include 'db_connect.php'; ?>
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

<div class="container mt-5">

    <h1 class="text-center mb-4">Available Rooms</h1>
    <div class="row">
        <?php
        $rooms = mysqli_query($conn, "SELECT * FROM rooms");
        while ($room = mysqli_fetch_assoc($rooms)) {
            ?>
            <div class="col-md-4 mt-4">
                <div class="card">
                    <img src="assets/images/<?php echo $room['image']; ?>" class="card-img-top" style = "height: 300px; object-fit: cover;">
                    <div class="card-body d-flex justify-content-between align-items-center" style="height: 150px;">
                        <div>
                            <h2 class="card-title"><?php echo $room['room_type']; ?></h2>
                            <p class="price-tag">₱<?php echo number_format($room['price'], 2); ?> per night</p>
                        </div>
                        <button class="btn btn-success book-now-btn" data-room-id="<?php echo $room['id']; ?>" data-room-type="<?php echo $room['room_type']; ?>">Book Now</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div id="reservationFormContainer" class="booking-form mt-5" style="display: none;">
        <h4 id="selectedRoomTitle">Book</h4>
        <form method="POST" action="save_reservation.php">
            <input type="hidden" name="room_id" id="selectedRoomId">
            <div class="mb-3">
                <label>First Name:</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Last Name:</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address:</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Contact Number:</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Check-in Date:</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Check-out Date:</label>
                <input type="date" name="checkout" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirm Reservation</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('reservationFormContainer').style.display='none';">Cancel</button>
        </form>
    </div>

</div>

<script>
document.querySelectorAll('.book-now-btn').forEach(button => {
    button.addEventListener('click', () => {
        const roomId = button.getAttribute('data-room-id');
        const roomType = button.getAttribute('data-room-type');

        document.getElementById('selectedRoomId').value = roomId;
        document.getElementById('selectedRoomTitle').innerText = 'Book ' + roomType;

        document.getElementById('reservationFormContainer').style.display = 'block';
        window.scrollTo({
            top: document.getElementById('reservationFormContainer').offsetTop - 100,
            behavior: 'smooth'
        });
    });
});
</script>

</body>
</html>
