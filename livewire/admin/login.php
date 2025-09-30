<?php
session_start();
include '../db_connect.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $admin = mysqli_fetch_assoc($query);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Planet Suites | Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('livewire.jpg'); /* Sample hotel image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.3); /* More transparent */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s, box-shadow 0.3s;
            backdrop-filter: blur(10px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        }
        .btn-primary {
            background-color: #6c5ce7;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5a4bd3;
        }
        h2 {
            font-family: 'Georgia', serif;
            color: #2d3436;
            margin-bottom: 20px;
        }
        label, input {
            color: #2d3436 !important;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2 class="text-center">Admin Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
