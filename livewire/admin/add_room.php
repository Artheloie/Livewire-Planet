<?php
session_start();
include '../db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_room'])) {
    $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image = $_FILES['image']['name'];

    if ($image) {
        $target = "../assets/images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        mysqli_query($conn, "INSERT INTO rooms (room_type, price, image) VALUES ('$room_type', '$price', '$image')");
        header('Location: rooms_list.php?success=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Room | Livewire Planet Suites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            padding-top: 30px;
            color: white;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #1abc9c;
            transition: 0.3s;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
            background: #fff;
        }
        .btn-custom {
            background: #1abc9c;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background: #16a085;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Livewire Planet Suites</h3>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
    <a href="add_room.php"><i class="fas fa-bed"></i> Add Room</a>
    <a href="rooms_list.php"><i class="fas fa-list"></i> Rooms List</a>
    <a href="reservations.php"><i class="fas fa-calendar-check"></i> Reservations Report</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h2 class="mb-4"><i class="fas fa-bed"></i> Add New Room</h2>

    <div class="card-custom">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <input type="text" name="room_type" class="form-control" placeholder="e.g. Deluxe Suite" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price (₱)</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price per night" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Room Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" name="add_room" class="btn btn-custom w-100">
                <i class="fas fa-plus-circle"></i> Add Room
            </button>
        </form>
    </div>
</div>

</body>
</html>
