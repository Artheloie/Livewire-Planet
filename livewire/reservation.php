<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book | Livewire Planet Suites</title>
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

        /* Room Card Styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .card .card-body {
            padding: 15px;
        }
        .price-tag {
            font-weight: bold;
            font-size: 18px;
        }
        .book-now-btn {
            margin-top: 10px;
        }

        /* Booking Form */
        .booking-form {
            max-width: 600px;
            margin: 40px auto;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .booking-form h4 {
            font-weight: bold;
            margin-bottom: 20px;
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

<!-- Available Rooms -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Available Rooms</h1>
    <div class="row">
        <?php
        $rooms = mysqli_query($conn, "SELECT * FROM rooms");
        while ($room = mysqli_fetch_assoc($rooms)) {
        ?>
            <div class="col-md-4 mt-4">
                <div class="card">
                    <img src="assets/images/<?php echo $room['image']; ?>" class="card-img-top" style="height: 300px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <div>
                            <h2 class="card-title"><?php echo $room['room_type']; ?></h2>
                            <p class="price-tag">₱<?php echo number_format($room['price'], 2); ?> per night</p>
                        </div>
                        <button class="btn btn-success book-now-btn" data-room-id="<?php echo $room['id']; ?>" data-room-type="<?php echo $room['room_type']; ?>">Book Now</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Reservation Form -->
<div id="reservationFormContainer" class="booking-form" style="display: none;">
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
        <div class="mb-3">
            <label>Optional Add-ons:</label>
            <div>
            <?php
            $addons = mysqli_query($conn, "SELECT * FROM addons");
            while ($addon = mysqli_fetch_assoc($addons)) {
            ?>
                <div class="form-check">
                    <input class="form-check-input addon-checkbox" type="checkbox" name="addons[]" value="<?php echo $addon['id']; ?>" data-price="<?php echo $addon['price']; ?>">
                    <label class="form-check-label">
                        <?php echo htmlspecialchars($addon['name']); ?> (₱<?php echo number_format($addon['price'], 2); ?>)
                    </label>
                </div>
            <?php } ?>
            </div>
        </div>
        <div class="mb-3">
            <label><b>Total Bill:</b></label>
            <div id="totalBill" style="font-size:1.2em; font-weight:bold;">₱0.00</div>
        </div>
        <button type="submit" class="btn btn-primary">Confirm Reservation</button>
        <button type="button" class="btn btn-secondary" onclick="document.getElementById('reservationFormContainer').style.display='none';">Cancel</button>
    </form>
</div>

<!-- Footer -->
<footer>
    <h4>&copy; All Rights Reserved | Livewire Planet Suites</h4>
</footer>

<script>
document.querySelectorAll('.book-now-btn').forEach(button => {
    button.addEventListener('click', () => {
        const roomId = button.getAttribute('data-room-id');
        const roomType = button.getAttribute('data-room-type');

        document.getElementById('selectedRoomId').value = roomId;
        document.getElementById('selectedRoomTitle').innerText = 'Book ' + roomType;

        document.getElementById('reservationFormContainer').style.display = 'block';

        // Set room price for total bill calculation
        const roomCard = button.closest('.card');
        const priceText = roomCard.querySelector('.price-tag').innerText;
        const roomPrice = parseFloat(priceText.replace(/[^\d.]/g, ''));
        window.selectedRoomPrice = roomPrice;

        function updateTotalBill() {
            let total = window.selectedRoomPrice || 0;
            document.querySelectorAll('.addon-checkbox:checked').forEach(cb => {
                total += parseFloat(cb.getAttribute('data-price'));
            });
            document.getElementById('totalBill').innerText = '₱' + total.toFixed(2);
        }

        document.querySelectorAll('.addon-checkbox').forEach(cb => {
            cb.addEventListener('change', updateTotalBill);
        });

        updateTotalBill();

        window.scrollTo({
            top: document.getElementById('reservationFormContainer').offsetTop - 100,
            behavior: 'smooth'
        });
    });
});
</script>

</body>
</html>
