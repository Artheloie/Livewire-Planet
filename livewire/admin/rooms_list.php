<?php
session_start();
include '../db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$rooms = mysqli_query($conn, "SELECT * FROM rooms ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms List | Livewire Planet Suites</title>
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
        .room-image {
            width: 120px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-warning {
            background: #f39c12;
            border: none;
        }
        .btn-warning:hover {
            background: #e67e22;
        }
        .btn-danger {
            background: #e74c3c;
            border: none;
        }
        .btn-danger:hover {
            background: #c0392b;
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
    <h2 class="mb-4"><i class="fas fa-list"></i> Rooms List</h2>

    <div class="card-custom">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Room</th>
                    <th>Price (₱)</th>
                    <th>Image</th>
                    <th style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($room = mysqli_fetch_assoc($rooms)) { ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($room['room_type']); ?></strong></td>
                        <td>₱<?php echo number_format($room['price'], 2); ?></td>
                        <td>
                            <img src="../assets/images/<?php echo htmlspecialchars($room['image']); ?>" class="room-image">
                        </td>
                        <td>
                            <a href="edit_room.php?id=<?php echo $room['id']; ?>" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="delete_room.php?id=<?php echo $room['id']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this room?');">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
