<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$room = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rooms WHERE id='$id'"));

if (isset($_POST['update_room'])) {
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    mysqli_query($conn, "UPDATE rooms SET room_type='$room_type', price='$price' WHERE id='$id'");
    header('Location: rooms_list.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('livewire.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: rgba(0, 0, 0, 0.85);
            min-height: 100vh;
            padding-top: 30px;
            position: fixed;
        }
        .sidebar h3 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: rgba(133, 208, 193, 0.95);
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            margin-left: 250px;
            padding: 50px;
            width: 100%;
        }
        .card-custom {
            background-color: rgba(133, 208, 193, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Livewire Planet Suites</h3>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
    <a href="reservations.php"><i class="fas fa-calendar-check"></i> Manage Reservations</a>
    <a href="add_room.php"><i class="fas fa-bed"></i> Add Rooms</a>
    <a href="rooms_list.php"><i class="fas fa-list"></i> Rooms List</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
    <div class="card-custom">
        <h2 class="text-center mb-4">Edit Room</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <input type="text" name="room_type" class="form-control" value="<?php echo $room['room_type']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $room['price']; ?>" required>
            </div>
            <button type="submit" name="update_room" class="btn btn-success w-100">Update Room</button>
        </form>
        <a href="rooms_list.php" class="btn btn-secondary mt-3 w-100">Back to Rooms List</a>
    </div>
</div>

</body>
</html>
