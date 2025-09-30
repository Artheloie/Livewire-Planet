<?php
session_start();
include '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']); // kunin current filename

// Handle Add Room
if (isset($_POST['add_room'])) {
    $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image']['name'];
        $target = "../assets/images/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO rooms (room_type, price, image) VALUES ('$room_type', '$price', '$image')";
            mysqli_query($conn, $sql);
        }
    }
}

// Handle Edit Room
if (isset($_POST['edit_room'])) {
    $id = intval($_POST['id']);
    $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Check if image uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../assets/images/" . basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "UPDATE rooms SET room_type='$room_type', price='$price', image='$image' WHERE id=$id";
        }
    } else {
        $sql = "UPDATE rooms SET room_type='$room_type', price='$price' WHERE id=$id";
    }
    mysqli_query($conn, $sql);
}

// Handle Delete Room
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM rooms WHERE id=$id");
    header("Location: rooms.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms | Livewire Planet Suites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f6fa; }
        .sidebar { width: 250px; background: #2c3e50; min-height: 100vh; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar h3 { text-align: center; margin-bottom: 30px; font-weight: bold; }
        .sidebar a { display: block; color: white; padding: 12px 20px; text-decoration: none; font-size: 16px; }
        .sidebar a:hover, .sidebar a.active { background: #1abc9c; transition: 0.3s; }
        .sidebar a i { margin-right: 10px; }
        .content { margin-left: 250px; padding: 30px; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 25px; background: #fff; }
        .room-image { width: 120px; border-radius: 10px; object-fit: cover; }
        .btn-warning { background: #f39c12; border: none; }
        .btn-warning:hover { background: #e67e22; }
        .btn-danger { background: #e74c3c; border: none; }
        .btn-danger:hover { background: #c0392b; }
        @media print { .no-print { display: none; } }
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
    <h2 class="mb-4"><i class="fas fa-bed"></i> Rooms</h2>

    <!-- Top Controls -->
    <div class="d-flex justify-content-between mb-3 no-print">
        <form class="d-flex" method="GET">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Rooms..." 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
        <div>
            <a href="rooms.php" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
            <button onclick="window.print()" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                <i class="fas fa-plus-circle"></i> Add New Room
            </button>
        </div>
    </div>

    <!-- Rooms Table -->
    <div class="card-custom">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Room Type</th>
                    <th>Price Rate (₱)</th>
                    <th>Image</th>
                    <th class="no-print" style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $query = "SELECT * FROM rooms WHERE room_type LIKE '%$search%' ORDER BY id DESC";
                $rooms = mysqli_query($conn, $query);
                if (mysqli_num_rows($rooms) > 0) {
                    while ($room = mysqli_fetch_assoc($rooms)) { ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($room['room_type']); ?></strong></td>
                            <td>₱<?php echo number_format($room['price'], 2); ?></td>
                            <td><img src="../assets/images/<?php echo htmlspecialchars($room['image']); ?>" class="room-image"></td>
                            <td class="no-print">
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editRoomModal<?php echo $room['id']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <a href="rooms.php?delete=<?php echo $room['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this room?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Room Modal -->
                        <div class="modal fade" id="editRoomModal<?php echo $room['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Room</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Room Type</label>
                                            <input type="text" name="room_type" class="form-control" 
                                                   value="<?php echo htmlspecialchars($room['room_type']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Price Rate(₱)</label>
                                            <input type="number" step="0.01" name="price" class="form-control" 
                                                   value="<?php echo htmlspecialchars($room['price']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Room Image (optional)</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <small>Current: <?php echo htmlspecialchars($room['image']); ?></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_room" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>

                    <?php }
                } else {
                    echo '<tr><td colspan="4" class="text-center">No rooms found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add New Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Room Type</label>
                    <input type="text" name="room_type" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price Rate(₱)</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Room Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_room" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Room</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
