<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Add User securely
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hashing

    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    header('Location: manage_users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | Livewire Planet Suites</title>
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
            background: #6c5ce7;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #5a4bd3;
        }
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
    <h2 class="mb-4"><i class="fas fa-users"></i> Manage Users</h2>

    <!-- Add User Form -->
    <div class="card-custom">
        <h4 class="mb-3">Add New User</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="add_user" class="btn btn-custom w-100">
                <i class="fas fa-plus"></i> Add User
            </button>
        </form>
    </div>

    <!-- Users List -->
    <div class="card-custom">
        <h4 class="mb-3">Users List</h4>
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = mysqli_query($conn, "SELECT * FROM users");
                while ($user = mysqli_fetch_assoc($users)) {
                    echo "
                    <tr>
                        <td>{$user['username']}</td>
                        <td>
                            <a href='edit_user.php?id={$user['id']}' class='btn btn-sm btn-warning me-2'>
                                <i class='fas fa-edit'></i> Edit
                            </a>
                            <a href='delete_user.php?id={$user['id']}' 
                               onclick=\"return confirm('Are you sure you want to delete this user?');\" 
                               class='btn btn-sm btn-danger'>
                                <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
