<?php
session_start();
include '../db_connect.php';

// Redirect to login if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch counts safely
$total_reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservations"))['total'] ?? 0;
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'] ?? 0;
$total_rooms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rooms"))['total'] ?? 0;
$total_addons = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM addons"))['total'] ?? 0;

// Detect current page
$current_page = basename($_SERVER['PHP_SELF']);
$report_pages = ['reservations.php', 'users_report.php', 'rooms_report.php'];
$is_report_page = in_array($current_page, $report_pages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | Livewire Planet Suites</title>
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
      text-align: center;
    }
    .stat-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }
    .bg-blue { color: #3498db; }
    .bg-green { color: #2ecc71; }
    .bg-orange { color: #e67e22; }
    .bg-red { color: #e74c3c; }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Livewire Planet Suites</h3>
    <a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_users.php" class="<?= $current_page == 'manage_users.php' ? 'active' : '' ?>"><i class="fas fa-users"></i> Manage Users</a>
    <a href="rooms.php" class="<?= $current_page == 'rooms.php' ? 'active' : '' ?>"><i class="fas fa-bed"></i> Rooms</a>
    <a href="addons.php" class="<?= $current_page == 'addons.php' ? 'active' : '' ?>"><i class="fas fa-plus"></i> Add-ons</a>
    <a href="amenities.php" class="<?= $current_page == 'amenities.php' ? 'active' : '' ?>"><i class="fas fa-cogs"></i> Amenities</a>

    <!-- Reports Dropdown -->
    <a href="#reportsSubmenu" data-bs-toggle="collapse" class="d-flex align-items-center <?= $is_report_page ? 'active' : '' ?>">
        <i class="fas fa-calendar-check me-2"></i> Report
        <i class="fas fa-caret-down ms-auto"></i>
    </a>
    <div class="collapse <?= $is_report_page ? 'show' : '' ?>" id="reportsSubmenu">
        <a href="reservations.php" class="ps-5 <?= $current_page == 'reservations.php' ? 'active' : '' ?>"><i class="fas fa-calendar-day"></i> Reservations</a>
    </div>

    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
  <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>

  <!-- Stats Row -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card-custom">
        <i class="fas fa-calendar-check stat-icon bg-blue"></i>
        <h3><?php echo $total_reservations; ?></h3>
        <p>Total Reservations</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-custom">
        <i class="fas fa-users stat-icon bg-green"></i>
        <h3><?php echo $total_users; ?></h3>
        <p>Total Users</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-custom">
        <i class="fas fa-bed stat-icon bg-orange"></i>
        <h3><?php echo $total_rooms; ?></h3>
        <p>Total Rooms</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-custom">
        <i class="fas fa-plus stat-icon bg-red"></i>
        <h3><?php echo $total_addons; ?></h3>
        <p>Total Add-ons</p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
