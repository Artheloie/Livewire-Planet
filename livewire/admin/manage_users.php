<?php
session_start();
include '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Add User securely
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $sql);

    header('Location: manage_users.php');
    exit();
}

// Edit User securely
if (isset($_POST['edit_user'])) {
    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username' WHERE id=$id";
    }

    mysqli_query($conn, $sql);
    header("Location: manage_users.php");
    exit();
}

// Delete User securely
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: manage_users.php");
    exit();
}

// Detect current page for active sidebar
$current_page = basename($_SERVER['PHP_SELF']);
$report_pages = ['reservations.php', 'users_report.php', 'rooms_report.php'];
$is_report_page = in_array($current_page, $report_pages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | Livewire Planet Suites</title>
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
        .btn-custom { background: #6c5ce7; color: #fff; border: none; }
        .btn-custom:hover { background: #5a4bd3; }
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
    <h2 class="mb-4"><i class="fas fa-users"></i> Manage Users</h2>

    <!-- Top Controls -->
    <div class="d-flex justify-content-between mb-3 no-print">
        <form class="d-flex" method="GET">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Users..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
        <div>
            <a href="manage_users.php" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
            <button onclick="window.print()" class="btn btn-info"><i class="fas fa-print"></i> Print to PDF</button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus-circle"></i> Add New User
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card-custom">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th class="no-print" style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $users = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY id DESC");
                if (mysqli_num_rows($users) > 0) {
                    while ($user = mysqli_fetch_assoc($users)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="no-print">
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editUserModal<?php echo $user['id']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <a href="manage_users.php?delete=<?php echo $user['id']; ?>"
                                   onclick="return confirm('Are you sure you want to delete this user?');"
                                   class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>

                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editUserModal<?php echo $user['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                   value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password (leave blank to keep current)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_user" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                <?php }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_user" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add User</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
