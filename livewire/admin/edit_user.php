<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include 'sidebar.php';

$id = intval($_GET['id']);
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if (isset($_POST['update_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id=$id");
    header('Location: manage_users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User | Livewire Planet Suites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="content" style="margin-left:220px; padding:30px;">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name="update_user" class="btn btn-success">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
