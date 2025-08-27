<?php 
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch counts
$total_reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservations"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$total_rooms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rooms"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard | Livewire Planet Suites</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .stat-card {
      padding: 25px;
      text-align: center;
      color: white;
      border-radius: 15px;
    }
    .bg-blue { background: #3498db; }
    .bg-green { background: #2ecc71; }
    .bg-orange { background: #e67e22; }
    .bg-red { background: #e74c3c; }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h3>Livewire Planet Suites</h3>
  <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
  <a href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
  <a href="add_room.php"><i class="fas fa-bed"></i> Add Rooms</a>
  <a href="rooms_list.php"><i class="fas fa-list"></i> Rooms List</a>
  <a href="reservations.php"><i class="fas fa-calendar-check"></i> Reservations Report</a>
  <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
  <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>

  <!-- Stats Row -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="stat-card bg-blue">
        <h3><?php echo $total_reservations; ?></h3>
        <p>Total Reservations</p>
        <i class="fas fa-calendar-check fa-2x"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card bg-green">
        <h3><?php echo $total_users; ?></h3>
        <p>Total Users</p>
        <i class="fas fa-users fa-2x"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card bg-orange">
        <h3><?php echo $total_rooms; ?></h3>
        <p>Total Rooms</p>
        <i class="fas fa-bed fa-2x"></i>
      </div>
    </div>
  </div>

<!-- Chart.js Script -->
<script>
  const ctx = document.getElementById('bookingsChart').getContext('2d');
  const bookingsChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
          datasets: [{
              label: 'Reservations',
              data: [12, 19, 10, 15, 22, 30, 25],
              backgroundColor: 'rgba(52, 152, 219, 0.2)',
              borderColor: '#3498db',
              borderWidth: 3,
              tension: 0.4,
              fill: true
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: { display: false }
          },
          scales: {
              y: { beginAtZero: true }
          }
      }
  });
</script>

</body>
</html>
