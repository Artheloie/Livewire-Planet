<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle Delete Reservation
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Delete related reservation_addons if exists
    mysqli_query($conn, "DELETE FROM reservation_addons WHERE reservation_id=$id");
    mysqli_query($conn, "DELETE FROM reservations WHERE id=$id");
    header('Location: reservations.php?deleted=1');
    exit();
}

// Fetch reservations with room details
$reservations = mysqli_query($conn, "
    SELECT r.*, rm.room_type, rm.image 
    FROM reservations r 
    JOIN rooms rm ON r.room_id = rm.id
");

// For sidebar active highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reservations | Livewire Planet Suites</title>
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
        .sidebar a:hover,
        .sidebar a.active {
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
            width: 90px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Livewire Planet Suites</h3>
    <a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_users.php" class="<?= $current_page == 'manage_users.php' ? 'active' : '' ?>"><i class="fas fa-users"></i> Manage Users</a>
    <a href="rooms.php" class="<?= $current_page == 'rooms.php' ? 'active' : '' ?>"><i class="fas fa-bed"></i> Rooms</a>
    <a href="addons.php" class="<?= $current_page == 'addons.php' ? 'active' : '' ?>"><i class="fas fa-plus"></i> Add-ons</a>
    <a href="amenities.php" class="<?= $current_page == 'amenities.php' ? 'active' : '' ?>"><i class="fas fa-cogs"></i> Amenities</a>

    <!-- Reports Dropdown -->
    <a href="#reportsSubmenu" data-bs-toggle="collapse" 
       class="d-flex align-items-center <?= in_array($current_page, ['reservations.php']) ? 'active' : '' ?>">
        <i class="fas fa-calendar-check me-2"></i> Report
        <i class="fas fa-caret-down ms-auto"></i>
    </a>
    <div class="collapse <?= in_array($current_page, ['reservations.php','users_report.php','rooms_report.php']) ? 'show' : '' ?>" id="reportsSubmenu">
        <a href="reservations.php" class="ps-5"><i class="fas fa-calendar-day"></i> Reservations</a>
    </div>

    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>


<!-- Content -->
<div class="content">
    <h2 class="mb-4"><i class="fas fa-calendar-check"></i> Manage Reservations</h2>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-danger">Reservation deleted successfully.</div>
    <?php endif; ?>

    <div class="card-custom">
        <div class="mb-3 text-end no-print">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> Print to PDF
            </button>
        </div>
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Room Type</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Room Image</th>
                    <th class="no-print" style="width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($reservations)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['checkin']); ?></td>
                        <td><?php echo htmlspecialchars($row['checkout']); ?></td>
                        <td>
                            <img src="../assets/images/<?php echo htmlspecialchars($row['image']); ?>" class="room-image" alt="Room">
                        </td>
                        <td class="no-print">
                            <a href="reservations.php?delete=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this reservation?');" 
                               class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
