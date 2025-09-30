<?php
session_start();
include '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle Add Amenity
if (isset($_POST['add_amenity'])) {
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    mysqli_query($conn, "INSERT INTO amenities (description) VALUES ('$description')");
    header('Location: amenities.php');
    exit();
}

// Handle Edit Amenity
if (isset($_POST['edit_amenity'])) {
    $id = intval($_POST['id']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    mysqli_query($conn, "UPDATE amenities SET description='$description' WHERE id=$id");
    header('Location: amenities.php');
    exit();
}

// Handle Delete Amenity
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM amenities WHERE id=$id");
    header("Location: amenities.php");
    exit();
}

// For sidebar active highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amenities | Livewire Planet Suites</title>
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
    <a href="dashboard.php" class="<?= $current_page=='dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="manage_users.php" class="<?= $current_page=='manage_users.php' ? 'active' : '' ?>"><i class="fas fa-users"></i> Manage Users</a>
    <a href="rooms.php" class="<?= $current_page=='rooms.php' ? 'active' : '' ?>"><i class="fas fa-bed"></i> Rooms</a>
    <a href="addons.php" class="<?= $current_page=='addons.php' ? 'active' : '' ?>"><i class="fas fa-plus"></i> Add-ons</a>
    <a href="amenities.php" class="<?= $current_page=='amenities.php' ? 'active' : '' ?>"><i class="fas fa-cogs"></i> Amenities</a>

    <!-- Reports Dropdown -->
    <a href="#reportsSubmenu" data-bs-toggle="collapse" 
       class="d-flex align-items-center <?= in_array($current_page, ['reservations.php','users_report.php','rooms_report.php']) ? 'active' : '' ?>">
        <i class="fas fa-calendar-check me-2"></i> Report
        <i class="fas fa-caret-down ms-auto"></i>
    </a>
    <div class="collapse <?= in_array($current_page, ['reservations.php','users_report.php','rooms_report.php']) ? 'show' : '' ?>" id="reportsSubmenu">
        <a href="reservations.php" class="ps-5 <?= $current_page=='reservations.php' ? 'active' : '' ?>"><i class="fas fa-calendar-day"></i> Reservations</a>
    </div>

    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h2 class="mb-4"><i class="fas fa-cogs"></i> Amenities</h2>

    <!-- Top Controls -->
    <div class="d-flex justify-content-between mb-3 no-print">
        <form class="d-flex" method="GET">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Amenities..." 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
        <div>
            <a href="amenities.php" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
            <button onclick="window.print()" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAmenityModal">
                <i class="fas fa-plus-circle"></i> Add New Amenity
            </button>
        </div>
    </div>

    <!-- Amenities Table -->
    <div class="card-custom">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Description</th>
                    <th class="no-print" style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $query = "SELECT * FROM amenities WHERE description LIKE '%$search%' ORDER BY id DESC";
                $amenities = mysqli_query($conn, $query);
                if (mysqli_num_rows($amenities) > 0) {
                    while ($amenity = mysqli_fetch_assoc($amenities)) { ?>
                        <tr>
                            <td><?php echo nl2br(htmlspecialchars($amenity['description'])); ?></td>
                            <td class="no-print">
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editAmenityModal<?php echo $amenity['id']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <a href="amenities.php?delete=<?php echo $amenity['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this amenity?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Amenity Modal -->
                        <div class="modal fade" id="editAmenityModal<?php echo $amenity['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Amenity</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $amenity['id']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($amenity['description']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_amenity" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>

                    <?php }
                } else {
                    echo '<tr><td colspan="2" class="text-center">No amenities found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Amenity Modal -->
<div class="modal fade" id="addAmenityModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Add New Amenity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Amenity Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_amenity" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Amenity</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
